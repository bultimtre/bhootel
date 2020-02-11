
        <?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
| Fabrizio c'è!
*/

$factory->define(Apartment::class, function (Faker $faker) {
    return [
        'description' => 'desc'.$faker -> sentence,
        'address' => $faker -> address,
        'rooms' => rand(1,5),
        'beds' => rand(1,5),
        'bath' => rand(1,3),
        'square_mt' => rand(50, 120)
    ];
});
