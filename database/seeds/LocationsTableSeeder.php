<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::query()->delete();
        Location::create(['name' => 'Location 1']);
        Location::create(['name' => 'Location 2']);
    }
}
