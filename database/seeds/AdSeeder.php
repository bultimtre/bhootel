<?php

use Illuminate\Database\Seeder;
use App\Ad;
use App\Apartment;

class AdSeeder extends Seeder
{    
    public function run()
    {
        factory(Ad::class, 3) 
                -> create()
                -> each(function($ad) {
                    $apartment = Apartment::inRandomOrder() -> first();
                    $ad -> apartments() -> attach($apartment);
        });
    }
}
