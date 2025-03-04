<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartsSeeder extends Seeder
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


                $category_name = $data['category'];
                $category = Category::where('category_name', $category_name)->first();

                $category_id = $category ? $category->id : null;

                Part::create([
                    'part_number' => $data['part_number'],
                    'part_desc' => $data['part_desc'],
                    'category_id' => $category_id
                ]);

            }
        }
    }
}
