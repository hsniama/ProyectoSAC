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
        Schema::create('diagnosis_disease', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('disease_id')->nullable()->constrained()->onDelete('restrict');
            $table->string('duration')->nullable();
            $table->string('status');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('diagnosis_disease');
    }
};
