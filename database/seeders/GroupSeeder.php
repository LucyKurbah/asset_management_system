<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::updateOrCreate(['group_name' => 'DC']);
        Group::updateOrCreate(['group_name' => 'NOC']);
        Group::updateOrCreate(['group_name' => 'Floor no 1']);
    }
}
