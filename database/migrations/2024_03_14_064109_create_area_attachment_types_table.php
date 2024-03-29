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

        Schema::create('area_attachment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('label', 1000);
            $table->boolean('is_single')->default(True);
            $table->json('file_types');
            $table->json('req_attr');
            $table->foreignId('budget_year_id')->constrained();
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
        Schema::dropIfExists('area_attachment_types');
    }
};
