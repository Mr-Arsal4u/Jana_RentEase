<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade')->name('rooms_property_id_foreign')->nullable();
            // $table->foreignId('room_type_id')->constrained()->onDelete('cascade')->name('rooms_room_type_id_foreign')->nullable();
            $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade')->name('rooms_room_type_id_foreign')->nullable();
            $table->string('room_no')->nullable();
            $table->string('room_name')->nullable();
            // $table->string('room_type')->nullable();
            $table->string('description')->nullable();
            $table->string('room_status')->nullable();
            $table->string('room_size')->nullable();
            $table->string('availablity_status')->nullable();
            $table->string('max_persons')->nullable();
            $table->string('view_side')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
