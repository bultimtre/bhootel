<?php

use Illuminate\Database\Seeder;
use App\Config;
use App\Apartment;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Config::class, 6) 
                -> create()
                -> each(function($config) {
                    $apartment = Apartment::inRandomOrder() -> take(rand(1, 5)) -> get();
                    $config -> apartments() -> attach($apartment);
        });
    }
}
