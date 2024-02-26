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

        Schema::create('relate_items', function (Blueprint $table) {
            $table->id();
            $table->string('label', 1000);
            $table->foreignId('budget_year_id')->constrained();
            $table->foreignId('relate_type_id')->constrained();
            $table->string('ref', 100);
            $table->string('parent_item_ref', 100)->nullable();
            $table->string('order')->nullable()->default('0');
            $table->boolean('req_value')->default(false);
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
        Schema::dropIfExists('relate_items');
    }
};
