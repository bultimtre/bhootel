<?php

use Illuminate\Database\Seeder;
use App\Stat;
use App\Apartment;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Stat::class, 10) 
                -> make()
                -> each(function($stat) {
                    $apartment = Apartment::inRandomOrder() -> first();
                    $stat -> apartment() -> associate($apartment);
                    $stat -> save(); 
        });
    }
}
