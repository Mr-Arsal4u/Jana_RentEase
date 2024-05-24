<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade')->nullable()->name('property_amounts_property_id_foreign');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade')->nullable()->name('property_amounts_currency_id_foreign'); 
            $table->string('total_amount')->nullable();
            $table->string('user_amount')->nullable();
            $table->string('admin_amount')->nullable();
            $table->string('tax')->nullable();
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
        Schema::dropIfExists('property_amounts');
    }
}
