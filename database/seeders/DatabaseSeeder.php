<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Amount;
use App\Models\Renter;
use App\Models\Booking;
use App\Models\Property;
use App\Models\AmountType;
use App\Models\RoomType;
use Database\Factories\AmenityFactory;
use Database\Factories\CurrencyFactory;
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

        $this->call([
            UsersSeeder::class,
            CurrencySeeder::class,
        ]);

        AmenityFactory::times(5)->create();

        // CurrencyFactory::times(5)->create();
        // RoomType::factory()->times(5)->create();
    }
}
