<?php

use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartment = [
            'description' => ['rustico', 'monolocale', 'bilocale'], 
            'address' => ['via roma','corso italia','via verdi'], 
            'rooms' => [4,1,2], 
            'beds' => [2,1,3], 
            'bath' => [3,1,1], 
            'square_mt' => [100,50,60]
        ];

    }
}



        // //3 categorie statiche
        // $categories = [
        //     ['title' => 'Tempo Libero', 'slug' => 'tempo-libero'],
        //     ['title' => 'Informatica', 'slug' => 'informatica'],
        //     ['title' => 'Viaggi', 'slug' => 'viaggi'],
        // ];

        // //cicliamo sulle categorie che vogliamo creare e salviamole
        // foreach ($categories as $category)
        // {
        //     $newCategory = new Category;
        //     $newCategory->fill($category);

        //     $newCategory->save();
        // }