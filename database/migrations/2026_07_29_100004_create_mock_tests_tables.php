<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mock_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('duration_minutes')->default(30);
            $table->unsignedTinyInteger('passing_score')->default(40);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        Schema::create('mock_test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mock_test_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->json('options');
            $table->unsignedTinyInteger('correct_option');
            $table->text('explanation')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('mock_test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mock_test_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->json('answers')->nullable();
            $table->unsignedSmallInteger('correct_answers')->default(0);
            $table->unsignedSmallInteger('total_questions')->default(0);
            $table->unsignedTinyInteger('score')->default(0);
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'mock_test_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mock_test_attempts');
        Schema::dropIfExists('mock_test_questions');
        Schema::dropIfExists('mock_tests');
    }
};
