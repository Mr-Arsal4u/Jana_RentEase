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
            $table->foreign('user_id')->references('id')->on('owners')->onDelete('cascade')->name('properties_owner_id_foreign');
            $table->string('property_name');
            $table->string('location');
            $table->string('bedrooms');
            $table->string('bathrooms');
            $table->string('area');
            $table->text('description')->nullable();
            $table->enum('status', ['Available', 'Booked', 'Unavailable'])->default('Available');;
            $table->string('max_persons');
            $table->string('view_side');
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
