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
            'name' => 'Kolomona',
            'lastName' => 'Myer',
            'nickName' => 'Kola',
            'active' => '1',
            'email' => 'kolomona@kolomona.com',
            'password' => Hash::make('iw20hapa')
        ]);

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@kolomona.com',
            'lastName' => 'Test',
            'nickName' => 'TestMan1',
            'active' => '1',
            'password' => Hash::make('iw20hapa')
        ]);

        $employee1 = User::create([
            'name' => 'Employee',
            'lastName' => 'Tester',
            'nickName' => 'Emp1',
            'active' => '1',
            'email' => 'employee1@kolomona.com',
            'password' => Hash::make('iw20hapa')
        ]);

        $employee2 = User::create([
            'name' => 'Employee2',
            'lastName' => 'Testing',
            'nickName' => 'Emp2',
            'active' => '1',
            'email' => 'employee2@kolomona.com',
            'password' => Hash::make('iw20hapa')
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $employee1->roles()->attach($employeeRole);
        $employee2->roles()->attach($employeeRole);
        
    }
}