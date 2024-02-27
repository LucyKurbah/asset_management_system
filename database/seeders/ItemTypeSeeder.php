<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemType;


class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        ItemType::updateOrCreate(['item_name' => 'Desktop']);
        ItemType::updateOrCreate(['item_name' => 'Switch']);
        ItemType::updateOrCreate(['item_name' => 'Router']);
       
    }
}
