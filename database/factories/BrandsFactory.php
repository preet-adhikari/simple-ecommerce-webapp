<?php

namespace Database\Factories;

use App\Models\Brands;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brands::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($this->faker->word()),
            'logo' => $this->faker->image(public_path('storage\images'),640,480,null,false),
        ];
    }
}
