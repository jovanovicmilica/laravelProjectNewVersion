<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('suppliers',\App\Http\Controllers\SupplierController::class);
Route::resource('parts',\App\Http\Controllers\PartController::class);
Route::resource('supplier_parts',\App\Http\Controllers\SupprierPartController::class);

Route::get('/supplier/{supplier_id}/export', [\App\Http\Controllers\SupprierPartController::class, 'exportSupplierPartsToCSV']);

