<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Config;


$factory->define(Config::class, function (Faker $faker) {
    return [
        'service' => 'conf'.$faker -> word
    ];
});
