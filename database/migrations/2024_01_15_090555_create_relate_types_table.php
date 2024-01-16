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
        Schema::create('relate_types', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name');
            $table->foreignId('budget_year_id')->references('id')->on('budget_years');
            $table->foreignId('relate_group_id')->references('id')->on('relate_groups');
            $table->boolean('is_parent')->default(False);
            $table->boolean('is_single')->default(True);
            $table->string('parent_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relate_types');
    }
};
