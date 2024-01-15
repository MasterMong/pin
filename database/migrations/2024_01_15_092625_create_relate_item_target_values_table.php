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
        Schema::create('relate_item_target_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->foreignId('budget_year_id')->references('id')->on('budget_years');
            $table->foreignId('relate_item_id')->references('id')->on('relate_items');
            $table->float('value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relate_item_target_values');
    }
};
