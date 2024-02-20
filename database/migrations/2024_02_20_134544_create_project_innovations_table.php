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

        Schema::create('project_innovations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('project_activity_id')->constrained();
            $table->foreignId('budget_year_id')->constrained();
            $table->string('attachment');
            $table->string('name', 600);
            $table->string('type', 600);
            $table->json('url');
            $table->longText('detail');
            $table->longText('use');
            $table->longText('problem');
            $table->longText('suggest');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_innovations');
    }
};
