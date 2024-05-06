<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Image;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Property::factory(20)->create();
        Image::factory(30)->create();
        Booking::factory(20)->create();
    }
}
