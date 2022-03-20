<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rack;
use App\Models\Shelf;

class RackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Lo que haremos en esta funcion sera: 
        Rack::factory()
            //crearemos tambien con los armarios, estantes que estaran asignados a los estantes
            // ver más: https://laravel.com/docs/9.x/database-testing#has-many-relationships-using-magic-methods
            ->has(Shelf::factory()
                        // Aca es lo mismo que lo anterior. Se crearan 5 Items
                        ->hasItems(5)
                        // Crearemos 5 Estantes, 25 items En Total
                        ->count(5)
            )
            // Crearemos 5 Armarios, 25 Estantes, 125 Items en Total
            ->count(5)
            // Los guardamos en la base de datos
            ->create();
    }
}
