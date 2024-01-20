<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2,0, 200),
            'quantity' => $this->faker->randomNumber(3, false),
            'brand_id' => $this->faker->randomElement(DB::table('brands')->pluck('id')),
        ];
    }
}
