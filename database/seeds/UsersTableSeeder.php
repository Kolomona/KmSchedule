<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();;
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $employeeRole = Role::where('name', 'employee')->first();

        $admin = User::create([
            'name' => 'Admin',
            'lastName' => 'CHANGEME',
            'nickName' => 'Hefe',
            'active' => '1',
            'email' => 'kolomona@kmschedule.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $employee1->roles()->attach($employeeRole);
        $employee2->roles()->attach($employeeRole);
        
    }
}