<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'SuperAdmin', 
            'email' => 'superadmin@mail.com', 
            'emp_code' => '0', 
            'designation' => 'SuperAdmin', 
            'division' => '1', 
            'group' => '1', 
            'password' => Hash::make('password'), 
            'role_id' => 1]);
        User::updateOrCreate([
            'name' => 'Admin', 
            'email' => 'admin@mail.com',
            'emp_code' => '1',  
            'designation' => 'Admin', 
            'division' => '1', 
            'group' => '1', 
            'password' => Hash::make('password'), 
            'role_id' => 2]);
    }

}
