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
            // $table->unsignedBigInteger('room_id')->constrained('rooms')->onDelete('cascade')->nullable();
            // $table->unsignedBigInteger('user_id')->constrained('users')->ondelete('cascade')->nullable();
            $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreignId('room_id')->references('id')->on('rooms')->onDelete('cascade')->name('bookings_room_id_foreign');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->string('days');
            $table->string('adults');
            $table->string('children');
            $table->integer('rooms_booked');
            $table->string('total_cost');
            $table->string('status')->default('Pending');
            $table->string('arrival_time')->nullable();
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
