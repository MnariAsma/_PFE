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
        Schema::create('syndicats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('super_admin_id');
            $table->unsignedBigInteger('cities_id');
            $table->string('name')->unique();
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->text('qrCode')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('super_admin_id')->references('id')->on('users');
            $table->foreign('cities_id')->references('id')->on('location_cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syndicats');
    }
};
