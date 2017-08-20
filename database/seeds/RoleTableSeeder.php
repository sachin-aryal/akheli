<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'client';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->save();
    }
}