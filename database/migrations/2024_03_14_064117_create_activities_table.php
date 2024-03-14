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

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('budget_year_id')->constrained();
            $table->string('name', 300);
            $table->string('code', 50);
            $table->string('duration', 100)->nullable();
            $table->string('date_start', 50)->nullable();
            $table->string('date_end', 50)->nullable();
            $table->string('q1');
            $table->string('q2');
            $table->string('q3');
            $table->string('q4');
            $table->longText('process')->nullable();
            $table->string('target_area', 1000);
            $table->json('relate_items');
            $table->foreignId('area_strategy_id')->constrained();
            $table->boolean('is_pa_of_manager')->default(false);
            $table->integer('progress')->nullable();
            $table->string('objective', 2000);
            $table->longText('problem')->nullable();
            $table->longText('suggestions')->nullable();
            $table->json('beneficiary');
            $table->boolean('is_success')->nullable();
            $table->json('galleries');
            $table->string('urls', 2000)->nullable();
            $table->string('handler_name')->nullable();
            $table->string('status', 50)->default('pending');
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
        Schema::dropIfExists('activities');
    }
};
