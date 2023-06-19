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
            $table->decimal('weight')->nullable();
            $table->decimal('body_mass_index')->nullable();
            $table->decimal('temperature')->nullable();
            $table->decimal('blood_pressure')->nullable();
            $table->decimal('heart_rate')->nullable();
            $table->decimal('respiratory_rate')->nullable();
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
