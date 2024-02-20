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

        Schema::create('relate_item_target_values', function (Blueprint $table) {
            $table->id();
            $table->string('label', 1000);
            $table->foreignId('budget_year_id')->constrained();
            $table->foreignId('relate_item_id')->constrained();
            $table->float('value')->default('0');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relate_item_target_values');
    }
};
