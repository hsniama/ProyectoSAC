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
        Schema::create('medical_exam_prescription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_exam_id')->constrained('medical_exams')->onDelete('restrict');
            $table->foreignId('prescription_id')->constrained('prescriptions')->onDelete('restrict');
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('medical_exam_prescription');
    }
};
