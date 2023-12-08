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
            $table->integer('code')->unique();
            $table->foreignId('area_type_id')->references('id')->on('area_types');
            $table->string('name');
            $table->foreignId('region_id')->references('id')->on('regions');
            $table->foreignId('inspection_id')->references('id')->on('inspection_areas');
            $table->string('address');
            $table->foreignId('province_id')->references('id')->on('provinces');
            $table->integer('zip_code');
            $table->string('tel');
            $table->integer('school_count');
            $table->integer('member_count');
            $table->string('website');
            $table->float('latitude')->nullable();
            $table->float('longtitude')->nullable();
            $table->json('etc');
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
