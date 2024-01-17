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
        Schema::create('relate_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_year_id')->references('id')->on('budget_years');
            $table->foreignId('relate_type_id')->references('id')->on('relate_types');
            $table->string('label', 2000);
            $table->string('ref');
            $table->string('parent_item_ref')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('req_value')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relate_items');
    }
};
