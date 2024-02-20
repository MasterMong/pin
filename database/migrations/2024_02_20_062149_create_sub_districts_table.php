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

        Schema::create('sub_districts', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name_in_thai', 300);
            $table->string('name_in_english', 300);
            $table->string('zip_code', 5)->nullable();
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->foreignId('province_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('area_strategy_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_districts');
    }
};
