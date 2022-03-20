<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    //Modelo correspondiente al factory
    protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->numberBetween(0,60),
            'column_start' => $this->faker->numberBetween(1,3),
            'column_end' => $this->faker->numberBetween(1,3),
            'row_start' => $this->faker->numberBetween(1,3),
            'row_end' => $this->faker->numberBetween(1,3),
            'shelf_id' => Shelf::factory()
        ];
    }
}
