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

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('name', 300);
            $table->string('address', 600)->nullable();
            $table->string('zip_code', 5)->nullable();
            $table->string('tel', 20);
            $table->integer('num_person')->default(0);
            $table->integer('num_school')->default(0);
            $table->integer('num_teacher')->default(0);
            $table->integer('num_student')->default(0);
            $table->string('website', 600);
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->foreignId('inspection_area_id')->constrained();
            $table->foreignId('area_type_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('province_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->json('etc')->nullable();
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
        Schema::dropIfExists('areas');
    }
};
