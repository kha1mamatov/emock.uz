<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('writing_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('one_skill_result_id')->constrained()->onDelete('cascade');
            $table->longText('answer');
            $table->unsignedInteger('word_count')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('writing_answers');
    }
};
