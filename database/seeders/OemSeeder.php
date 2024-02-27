<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oem;

class OemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Oem::updateOrCreate(['oem_name' => 'Cisco']);
        Oem::updateOrCreate(['oem_name' => 'HLBS']);
        Oem::updateOrCreate(['oem_name' => 'Dell']);
    }
}
