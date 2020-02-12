<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Apartment;


$factory->define(Apartment::class, function (Faker $faker) {
    return [
        'description' => 'desc-'.$faker -> sentence,
        'address' => $faker -> address,
        'rooms' => rand(1,5),
        'beds' => rand(1,5),
        'bath' => rand(1,3),
        'square_mt' => rand(50, 120),
        'lat' => $faker -> latitude($min = -90, $max = 90),
        'lon' => $faker -> longitude($min = -180, $max = 180),
        'image' => $faker -> imageUrl($width = 400, $height = 200, 'city')
         
    ];
});
