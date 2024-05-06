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
            // $table->string('property_id');
            // $table->string('user_id')->nullable();
            $table->string('renter_name');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('days');
            $table->string('adults');
            $table->string('children');
            $table->string('email');
            $table->string('total_price');
            $table->string('status')->default('Pending');
            $table->time('arrival_time')->nullable();
            // $table->string('payment_status')->default('Pending');
            // $table->string('payment_method')->default('Cash');
            //  $table->string('payment_id')->nullable();   
            $table->foreignId('renter_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade')->nullable();
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
