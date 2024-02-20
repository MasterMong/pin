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

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('budget_year_id')->constrained();
            $table->string('name', 300);
            $table->string('code', 50);
            $table->string('objective', 1000);
            $table->longText('indicator');
            $table->string('duration', 100)->nullable();
            $table->string('date_start', 50);
            $table->string('date_end', 50);
            $table->float('budget');
            $table->foreignId('area_strategy_id')->constrained();
            $table->boolean('is_pa_of_manager')->default(false);
            $table->longText('problem')->nullable();
            $table->longText('suggestions')->nullable();
            $table->integer('progress')->nullable();
            $table->json('relate_items');
            $table->string('handler_name')->nullable();
            $table->string('status', 50);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
