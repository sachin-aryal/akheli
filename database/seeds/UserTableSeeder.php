<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Client;

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
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('admin');
        $manager->save();
        $manager->roles()->attach($role_admin);
        $manager->client=Client::create([
            'name'=>"Admin",
            'shop_name'=>"NO",
            'phone_no'=>"NO",
            'location'=>"NO",
            'user_id'=>$manager->id,
        ]);
    }
}