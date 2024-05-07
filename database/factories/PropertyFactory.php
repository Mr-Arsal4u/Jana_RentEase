<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_name' => $this->faker->name(),
            'location' => $this->faker->address(),
            'bedrooms' => $this->faker->randomDigit(),
            'bathrooms' => $this->faker->randomDigit(),
            'garages' => $this->faker->randomDigit(),
            'area' => $this->faker->randomDigit(),
            'description' => $this->faker->text(),
            'status' => 'Available',
            'max_persons' => $this->faker->randomDigit(),
            'rating' => $this->faker->randomDigit(),
            'view_side' => $this->faker->randomElement(['Sea', 'Mountain', 'City']),
            'bed' => $this->faker->randomElement(['Single', 'Double', 'King', 'Queen']),
            'floors' => $this->faker->randomDigit(),
            'kitchen' => $this->faker->randomDigit(),
            'renter_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
