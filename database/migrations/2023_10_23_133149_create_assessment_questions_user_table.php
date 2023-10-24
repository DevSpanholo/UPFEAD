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
        Schema::create('assessment_questions_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_user_id');
            $table->foreign('assessment_user_id')->references('id')->on('assessment_user')->onDelete('cascade');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedBigInteger('question_option_id');
            $table->foreign('question_option_id')->references('id')->on('questions_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_questions_user');
    }
};
