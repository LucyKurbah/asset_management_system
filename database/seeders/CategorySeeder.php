<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(['category_name' => 'Networking']);
        Category::updateOrCreate(['category_name' => 'VC']);
        Category::updateOrCreate(['category_name' => 'PC']);
        Category::updateOrCreate(['category_name' => 'Others']);
        Category::updateOrCreate(['category_name' => 'Data Centres']);
    }
}
