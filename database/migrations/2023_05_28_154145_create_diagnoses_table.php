<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('restrict');
            $table->string('allergies')->nullable();
            $table->string('current_medication')->nullable();
            $table->string('drug_use');
            $table->string('alcohol_use');
            $table->string('smoking_use');
            $table->string('family_background')->nullable();
            $table->string('surgical_history')->nullable();
            $table->text('reason_for_consultation');
            $table->text('conclusions');
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
        Schema::dropIfExists('diagnoses');
    }
};
