<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Food'],
            ['name' => 'Tools'],
        ];

        ProductCategory::insert($data);

        // $category = new ProductCategory();
        // $category->name = "nwm";
        // // dd($category->save());
        // $category->save();
    }
}
