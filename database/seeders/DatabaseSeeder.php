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
        
        $this->call(UsersSeeder::class);
        
    }
}
