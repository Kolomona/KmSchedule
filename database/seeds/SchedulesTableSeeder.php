<?php

use App\Location;
use App\Schedule;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Schedule::query()->delete();
        //factory(App\Schedule::class, 6)->create();

        $location1 = Location::where('name','Location 1')->first(); 

        $location1Schedule = Schedule::create([
            'period_date' => '2020-03-15',
            'schedule' => 'Location 1 Schedule',
            'is_draft' => '0'
        ]);

        $location1->schedules()->save($location1Schedule);
        


    }
}
