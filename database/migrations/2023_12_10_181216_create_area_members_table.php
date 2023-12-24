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
        Schema::create('area_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_type_id')->references('id')->on('area_member_types');
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->unsignedInteger('attachment_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_members');
    }
};
