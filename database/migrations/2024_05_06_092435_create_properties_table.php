<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('location');
            $table->string('bedrooms');
            $table->string('bathrooms');
            $table->string('garages')->nullable();
            $table->string('area');
            $table->string('description');
            $table->string('status')->default('Available');
            $table->string('max_persons');
            $table->string('rating');
            $table->string('view_side');
            $table->string('bed');
            $table->string('floors');
            $table->string('kitchen');
            // $table->string('slab_type');
            $table->foreignId('renter_id')->constrained('users')->onDelete('cascade')->nullable();
            // $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
