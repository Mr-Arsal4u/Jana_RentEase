<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Amount;
use App\Models\Booking;
use App\Models\Property;
use App\Models\AmountType;
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
        Amount::factory(20)->create();
        Image::factory(30)->create();
        // Booking::factory(20)->create();
        ///i have to set house area bigger like 200 and room area like 10 or 6 in form on admin side via jquery
    }
}
