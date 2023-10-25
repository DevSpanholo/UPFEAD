<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('assessment_id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade'); // Adicionado relacionamento
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
