<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Ad;


$factory->define(Ad::class, function (Faker $faker) {
    return [
        'price' => rand(100, 1000)
    ];
});
