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
        Schema::create('areas', function (Blueprint $table) {
            // $table->integer('area_type_id');
            // $table->integer('region_id');
            // $table->integer('inspection_id');
            // $table->integer('province_id');
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('area_type_id')->references('id')->on('area_types');
            $table->foreignId('region_id')->references('id')->on('regions');
            $table->foreignId('inspection_id')->references('id')->on('inspection_areas');
            $table->string('address')->nullable();
            $table->foreignId('district_id')->references('id')->on('districts');
            $table->foreignId('province_id')->references('id')->on('provinces');
            $table->integer('zip_code')->nullable();
            $table->string('tel')->nullable();
            $table->integer('school_count')->default(0);
            $table->integer('member_count')->default(0);
            $table->string('website')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->json('etc')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
