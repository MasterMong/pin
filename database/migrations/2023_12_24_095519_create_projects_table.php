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
            $table->string('duration')->nullable();
            $table->string("date_start");
            $table->string("date_end");
            $table->float('budget');
            $table->foreignId('area_strategy_id')->references('id')->on('area_strategies');
            $table->boolean('is_pa_of_manager')->default(false);
            $table->longText('problem')->nullable();
            $table->longText('suggestions')->nullable();
            $table->integer('progress')->nullable();
            // $table->json('relate_type_id')->nullable();
            $table->json('relate_items')->nullable();
            $table->string('handler_name')->nullable();
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
