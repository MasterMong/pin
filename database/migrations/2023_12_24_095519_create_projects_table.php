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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->foreignId('budget_year_id')->references('id')->on('budget_years');
            $table->string('name');
            $table->string('code');
            $table->string('objective');
            $table->longText('indicator');
            $table->string('duration');
            $table->date("date_start");
            $table->date("date_end");
            $table->float('budget');
            $table->foreignId('area_startegy_id')->references('id')->on('area_startegies');
            $table->boolean('is_pa_of_manager')->default(false);
            $table->longText('problem');
            $table->longText('suggestions');
            $table->integer('progress');
            $table->string('handler_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
