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
        Schema::create('questions_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_user_id');
            $table->foreign('assessment_user_id')->references('id')->on('assessment_user')->onDelete('cascade');
            $table->unsignedBigInteger('questions_options_id');
            $table->foreign('questions_options_id')->references('id')->on('questions_options')->onDelete('cascade');
            $table->unsignedBigInteger('questions_id');
            $table->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_options');
    }
};
