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
        Schema::create('area_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_startegy_id')->references('id')->on('area_startegies');
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->foreignId('budget_year_id')->references('id')->on('budget_years');
            $table->string('name');
            $table->string('indicator');
            $table->string('unit');
            $table->string('target_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_targets');
    }
};
