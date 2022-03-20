<?php

namespace Database\Factories;

use App\Models\Shelf;
use App\Models\Rack;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShelfFactory extends Factory
{
    protected $model = Shelf::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(6),
            'rows' => $this->faker->numberBetween(1,3),
            'columns' => $this->faker->numberBetween(1,3),
            'rack_id' => Rack::factory()
        ];
    }
}
