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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('copropriete_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('responsable_name');
            $table->string('responsable_contact');
            $table->string('frequence');
            $table->string('type');
            $table->float('prix');
            $table->date('start_date');
            $table->foreign('copropriete_id')->references('id')->on('coproprietes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
