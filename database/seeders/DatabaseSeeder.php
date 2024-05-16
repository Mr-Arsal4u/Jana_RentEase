<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Amount;
use App\Models\Renter;
use App\Models\Booking;
use App\Models\Property;
use App\Models\AmountType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(4)->create();
        // $this->userSeeder();
        // return $this->();
        // UsersSeeder::class;
        $this->call(UsersSeeder::class);
        // Property::factory(4)->create();
        // Image::factory(4)->create();
        // Booking::factory(3)->create();
        ///i have to set house area bigger like 200 and room area like 10 or 6 in form on admin side via jquery
    }
}
