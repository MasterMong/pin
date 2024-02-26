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
        Schema::disableForeignKeyConstraints();

        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('budget_year_id')->constrained();
            $table->string('name', 300);
            $table->longText('process');
            $table->string('target_area', 1000);
            $table->longText('result');
            $table->integer('count_beneficiary');
            $table->boolean('is_success')->nullable();
            $table->longText('unsuccessful_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_activities');
    }
};
