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
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('body_mass_index', 5, 2)->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('blood_pressure', 5, 2)->nullable();
            $table->decimal('heart_rate', 5, 2)->nullable();
            $table->decimal('respiratory_rate', 5, 2)->nullable();
            $table->string('status')->default('Sin llenar');
            $table->string('updated_by')->nullable(); 
            $table->string('created_by')->nullable(); 
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
