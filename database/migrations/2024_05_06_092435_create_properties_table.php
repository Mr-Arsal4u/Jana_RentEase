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
            $table->foreignId('owner_id')->constrained()->onDelete('cascade')->name('properties_owner_id_foreign')->nullable();
            $table->string('property_no')->nullable();
            $table->string('property_name')->nullable();
            $table->string('location')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('property_area')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->integer('total_rooms')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('application_status')->nullable()->default('incomplete');
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
