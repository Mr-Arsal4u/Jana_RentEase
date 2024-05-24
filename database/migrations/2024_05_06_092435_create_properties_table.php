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
            // $table->foreign('user_id')->references('id')->on('owners')->onDelete('cascade')->name('properties_owner_id_foreign')->nullable();
            $table->string('property_no')->nullable();
            $table->string('property_name')->nullable();
            $table->string('location')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('area')->nullable();
            $table->text('description')->nullable();
            $table->string('application_status')->nullable()->default('incomplete');
            $table->boolean('status')->default(1)->nullable();
            $table->string('max_persons')->nullable();
            $table->string('view_side')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
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
