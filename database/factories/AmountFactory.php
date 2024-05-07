<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['Apartment', 'House']);
        $per_night = $type === 'Apartment'? 1 : 0;
    
        return [
            'amount' => $this->faker->randomNumber(4),
            'type' => $type,
            'property_id' => Property::inRandomOrder()->value('id'),
            'per_night' => $per_night,
        ];
    }
    
    
}
