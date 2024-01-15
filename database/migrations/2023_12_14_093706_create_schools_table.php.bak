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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('num_manager');
            $table->integer('num_teacher');
            $table->integer('num_student');
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->integer('smiss_id');
            $table->integer('obec_id');
            $table->foreignId('district_id')->references('id')->on('districts');
            $table->foreignId('province_id')->references('id')->on('provinces');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
