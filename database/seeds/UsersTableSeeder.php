<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;
use App\Location;

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
        $location = Location::all()->first();
        // $managerRole = Role::where('name', 'manager')->first();
        // $employeeRole = Role::where('name', 'employee')->first();

        $admin = User::create([
            'name' => 'Admin',
            'lastName' => 'CHANGEME',
            'nickName' => 'Hefe',
            'active' => '1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'location_id' => $location->id

        ]);

        $admin->roles()->attach($adminRole);
       
    }
}