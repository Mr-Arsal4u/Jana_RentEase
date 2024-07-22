<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyRoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => 1,
            'room_type_id' => 1,
            'count' => 1,
        ];
    }
}
