<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierPart;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $per_page = $request->get('per_page', 15);

        // Get supplier-parts with pagination
//        $supplierParts = Supplier_Part::paginate($per_page);


        $supplierParts = SupplierPart::with(['part.category', 'condition:id,condition_name','part.category'])
            ->paginate($per_page)
            ->through(function ($supplierPart) {
                return [
                    'supplier_name' => $supplierPart->supplier->supplier_name,
                    'days_valid' => $supplierPart->days_valid,
                    'priority' => $supplierPart->priority,
                    'part_number' => $supplierPart->part ? $supplierPart->part->part_number : 'N/A',
                    'part_desc' => $supplierPart->part ? $supplierPart->part->part_desc : 'N/A',
                    'quantity' => $supplierPart->quantity,
                    'price' => $supplierPart->price,
                    'condition_name' => $supplierPart->condition ? $supplierPart->condition->condition_name : 'N/A',
                    'category' => optional($supplierPart->part->category)->category_name ?? 'N/A',
                ];
            });

        return response()->json($supplierParts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportSupplierPartsToCSV($id)
    {
        $supplier = Supplier::find($id);


        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplierParts = SupplierPart::with(['part.category', 'condition'])
            ->where('supplier_id', $id)
            ->get();

        if ($supplierParts->isEmpty()) {
            return response()->json(['message' => 'No parts found for this supplier'], 404);
        }

        $supplierName = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($supplier->supplier_name)); // Convert non-alphanumeric to "_"
        $timestamp = Carbon::now()->format('Y_m_d-H_i'); // Format: 2025_02_16-12_30
        $filename = "{$supplierName}_{$timestamp}.csv";

        $csvData = "Part Number,Part Description,Category,Quantity,Price,Condition\n";

        foreach ($supplierParts as $part) {
            $csvData .= "{$part->part->part_number},";
            $csvData .= "\"{$part->part->part_desc}\",";
            $csvData .= $part->part->category ? $part->part->category->category_name : "N/A";
            $csvData .= ",{$part->quantity},";
            $csvData .= "{$part->price},";
            $csvData .= $part->condition ? $part->condition->condition_name : "N/A";
            $csvData .= "\n";
        }

        Storage::put("exports/{$filename}", $csvData);

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
