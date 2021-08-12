<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->numberBetween($min = 1000, $max = 9000) ;
        return [
            'name' => $this->faker->word(),
            'price' => $price ,
            'animation' => $this->faker->word(),
            'image' => $this->faker->word(),
            'description' => $this->faker->word(),
        ];
    }
}
