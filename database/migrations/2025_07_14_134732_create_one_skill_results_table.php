<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('one_skill_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mock_test_id')->constrained()->onDelete('cascade');

            $table->enum('skill', ['writing'])->default('writing');
            $table->enum('status', ['pending', 'reviewed'])->default('pending');

            $table->float('band_score')->nullable();

            $table->float('task_response')->nullable();
            $table->float('coherence_cohesion')->nullable();
            $table->float('vocabulary')->nullable();
            $table->float('grammar')->nullable();

            $table->json('evaluation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('one_skill_results');
    }
};

