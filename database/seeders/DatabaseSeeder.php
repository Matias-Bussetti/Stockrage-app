<?php

namespace Database\Seeders;

use App\Models\Rack;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // Para Ejecutar los seeder, en consola escribiremos: 
    // php artisan db:seed
    // o en el caso que queramos ejecutar una clase en especial escribiremos:
    // php artisan db:seed -class=NameSeederitems
    public function run()
    {
        //Este metodo llama a los seeders y los ejecuta
        $this->call(
            [
                RackSeeder::class
            ]
        );
    }
}
