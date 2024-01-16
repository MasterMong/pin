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
        Schema::create('area_attchment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label', 2000);
            $table->boolean('is_single')->default(true);
            $table->string('file_types');
            $table->json('req_attr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_attchment_types');
    }
};
