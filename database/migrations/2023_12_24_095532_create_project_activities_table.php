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
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->string('name');
            $table->string('process');
            $table->date('do_date');
            $table->string('target_area');
            $table->string('result');
            $table->integer('count_beneficiary');
            $table->boolean('is_success')->nullable();
            $table->longText('unsuccess_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_activities');
    }
};
