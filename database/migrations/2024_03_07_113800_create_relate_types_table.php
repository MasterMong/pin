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

        Schema::create('relate_types', function (Blueprint $table) {
            $table->id();
            $table->string('label', 1000);
            $table->string('name', 100);
            $table->foreignId('budget_year_id')->constrained();
            $table->foreignId('relate_group_id')->constrained();
            $table->boolean('is_parent')->default(false);
            $table->boolean('is_single')->default(true);
            $table->string('parent_name', 100)->nullable();
            $table->string('order')->nullable()->default('0');
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
        Schema::dropIfExists('relate_types');
    }
};
