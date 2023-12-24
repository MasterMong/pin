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
        Schema::create('project_innovations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('project_activity_id')->references('id')->on('project_activities');
            $table->unsignedInteger('attachment_id');
            $table->string('name');
            $table->string('type');
            $table->string('url')->nullable();
            $table->longText('detail');
            $table->longText('use');
            $table->longText('problem');
            $table->longText('suggess');
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
        Schema::dropIfExists('project_innovations');
    }
};
