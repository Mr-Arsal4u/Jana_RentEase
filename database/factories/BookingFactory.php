<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'renter_name' => $this->faker->name(),
            'check_in' => $this->faker->date(),
            'check_out' => $this->faker->date(),
            'days' => $this->faker->randomDigit(),
            'adults' => $this->faker->randomDigit(),
            'children' => $this->faker->randomDigit(),
            'email' => $this->faker->email(),
            'total_price' => $this->faker->randomNumber(4),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Declined']),
            'arrival_time' => $this->faker->time(),
            'renter_id' => User::inRandomOrder()->value('id'),
            'property_id' => Property::inRandomOrder()->value('id'),
        ];
    }
}
