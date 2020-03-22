<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'period_date' => $faker->dateTimeBetween($startDate = '-12 months', $endDate = 'now', $timezone = null),
        'schedule' => $faker->sentence( $nbwords=10 ),
        'is_draft' => $faker->boolean($chanceOfGettingTrue=75)
    ];
});


