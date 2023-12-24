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
            $table->string('code')->unique();
            $table->foreignId('area_type_id')->references('id')->on('area_types');
            $table->string('name');
            $table->foreignId('inspection_id')->references('id')->on('inspection_areas');
            $table->string('address')->nullable();
            $table->foreignId('district_id')->references('id')->on('districts');
            $table->foreignId('province_id')->references('id')->on('provinces');
            $table->foreignId('region_id')->references('id')->on('regions');
            $table->integer('zip_code')->nullable();
            $table->string('tel')->nullable();
            $table->integer('num_person')->default(0);
            $table->integer('num_school')->default(0);
            $table->integer('num_teacher')->default(0);
            $table->integer('num_student')->default(0);
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
