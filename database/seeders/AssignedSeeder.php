<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assigned;

class AssignedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assigned::updateOrCreate(['assigned_to' => 'Self']);
        Assigned::updateOrCreate(['assigned_to' => 'Programmer']);
    }
}
