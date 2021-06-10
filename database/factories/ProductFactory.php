<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3, true),
            'regular_price' => $this->faker->numberBetween(10000, 10000),
            'discount_type' => $this->faker->randomElement(['amount', 'percentage']),
            'discount'  => $this->faker->numberBetween(10, 70),
            'unit_type' => $this->faker->randomElement(['kg', 'pcs']),
            'unit' => $this->faker->numberBetween(10, 70),
            'stock' => $this->faker->numberBetween(10, 30),
            'description' => $this->faker->sentence(500)
        ];
    }
}
