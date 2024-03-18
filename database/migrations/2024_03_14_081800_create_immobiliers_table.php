<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('immobiliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('syndicat_id')->constrained();
            $table->string('name');
            $table->unsignedBigInteger('city_id');
            $table->string('address');
            $table->integer('apartements_number')->nullable;
            $table->string('floors_number');
            $table->string('description');
            $table->foreign('city_id')->references('id')->on('location_cities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immobiliers');
    }
};
