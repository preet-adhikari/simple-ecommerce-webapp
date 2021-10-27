<?php

namespace Database\Factories;

use App\Models\Brands;
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
            'brand_id' => Brands::factory(),
            'name' => ucfirst($this->faker->unique()->word()),
            'stock' => $this->faker->numberBetween(0,1000),
            'price' => $this->faker->numberBetween(0,20000),
            'image' => $this->faker->image(public_path('storage\images'),640,480,null,false)
        ];
    }
}
