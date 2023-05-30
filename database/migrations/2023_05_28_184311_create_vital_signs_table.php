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
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('restrict');
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('body_mass_index')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('blood_pressure')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->string('status')->default('Sin Llenar'); //Llenada, Sin Llenar,
            $table->string('filled_by')->nullable();
            $table->string('updated_by')->nullable(); 
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
        Schema::dropIfExists('vital_signs');
    }
};
