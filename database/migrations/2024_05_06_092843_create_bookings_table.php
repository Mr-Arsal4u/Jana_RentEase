<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('renters')->onDelete('cascade')->name('bookings_renter_id_foreign');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade')->name('bookings_property_id_foreign');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('days');
            $table->string('adults');
            $table->string('children');
            $table->string('status')->default('Pending');
            $table->time('arrival_time')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
