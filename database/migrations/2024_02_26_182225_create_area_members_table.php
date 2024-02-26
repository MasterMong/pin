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

        Schema::create('area_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_member_type_id')->constrained();
            $table->foreignId('area_id')->constrained();
            $table->string('cover_image', 1000);
            $table->string('name', 300);
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
        Schema::dropIfExists('area_members');
    }
};
