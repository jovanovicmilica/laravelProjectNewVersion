<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\SupplierPart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = public_path('suppliers.csv');
        $csvData = file_get_contents($csvFile);
        $rows = explode("\n", $csvData);
        $header = str_getcsv(array_shift($rows));

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (count($data) == count($header)) {
                $data = array_combine($header, $data);

                if($data['supplier_name']!=""){
                    Supplier::firstOrCreate(
                        ['supplier_name' => $data['supplier_name']],
                    );
                }

            }
        }
    }
}
