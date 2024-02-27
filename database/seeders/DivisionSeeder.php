<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::updateOrCreate(['division_name' => 'MLSC']);
        Division::updateOrCreate(['division_name' => 'EKH']);
        Division::updateOrCreate(['division_name' => 'WKH']);
    }
}
