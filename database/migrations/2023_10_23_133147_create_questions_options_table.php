<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions_options', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->enum('is_correct', ['1', '0'])->default('0')->nullable();
            $table->unsignedBigInteger('question_id'); 
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions_options');
    }
};
