<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->delete();
        $role_client = Role::where('name', 'client')->first();
        $role_admin  = Role::where('name', 'admin')->first();
//        $employee = new User();
//        $employee->name = 'sachin';
//        $employee->email = 'sachin@example.com';
//        $employee->password = bcrypt('secret');
//        $employee->save();
//        $employee->roles()->attach($role_client);
        $manager = new User();
        $manager->name = 'admin';
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('admin');
        $manager->save();
        $manager->roles()->attach($role_admin);
    }
}
