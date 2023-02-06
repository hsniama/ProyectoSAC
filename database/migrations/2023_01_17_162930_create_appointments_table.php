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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('people');
            $table->foreignId('doctor_id')->constrained('people');
            $table->foreignId('speciality_id')->constrained();
            $table->date('scheduled_date');
            $table->time('scheduled_time', 0);
            $table->string('status')->default('Pendiente'); //Pendiente, Cancelado, Atendido
            $table->text('notes')->nullable(); //Motivo de la cita.
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
        Schema::dropIfExists('appointments');
    }
};
