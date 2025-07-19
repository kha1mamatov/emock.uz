<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mock_tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('prompt');
            $table->text('model_answer')->nullable();
            $table->enum('task_type', ['1', '2']); // Task 1 or 2
            $table->json('writing_type')->nullable();
            $table->json('categories')->nullable(); // Optional topic tags
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mock_tests');
    }
};
