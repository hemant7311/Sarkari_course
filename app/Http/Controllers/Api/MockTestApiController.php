<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MockTest;
use App\Models\MockTestAttempt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MockTestApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tests = MockTest::query()->where('is_published', true)->withCount('questions')
            ->when($request->filled('course_id'), fn ($query) => $query->where('course_id', $request->integer('course_id')))
            ->latest()->paginate(12);

        return response()->json(['success' => true, 'data' => $tests->getCollection()->map(fn (MockTest $test) => $this->summary($test)), 'meta' => ['current_page' => $tests->currentPage(), 'last_page' => $tests->lastPage()]]);
    }

    public function show(Request $request, MockTest $mockTest): JsonResponse
    {
        abort_unless($mockTest->is_published, 404);
        $mockTest->load('questions');

        return response()->json(['success' => true, 'data' => array_merge($this->summary($mockTest), [
            'questions' => $mockTest->questions->map(fn ($question) => ['id' => $question->id, 'question' => $question->question, 'options' => $question->options]),
        ])]);
    }

    public function submit(Request $request, MockTest $mockTest): JsonResponse
    {
        abort_unless($mockTest->is_published, 404);
        $validated = $request->validate(['answers' => ['required', 'array'], 'answers.*' => ['nullable', 'integer', 'min:0', 'max:20']]);
        $questions = $mockTest->questions()->get();
        abort_if($questions->isEmpty(), 422, 'This test has no questions yet.');

        $answers = collect($validated['answers'])->mapWithKeys(fn ($answer, $id) => [(int) $id => $answer])->all();
        $correct = $questions->filter(fn ($question) => array_key_exists($question->id, $answers) && (int) $answers[$question->id] === $question->correct_option)->count();
        $total = $questions->count();
        $score = (int) round(($correct / $total) * 100);
        $attempt = MockTestAttempt::create([
            'mock_test_id' => $mockTest->id,
            'user_id' => $request->user()->id,
            'answers' => $answers,
            'correct_answers' => $correct,
            'total_questions' => $total,
            'score' => $score,
            'submitted_at' => now(),
        ]);

        return response()->json(['success' => true, 'data' => ['attempt_id' => $attempt->id, 'score' => $score, 'correct_answers' => $correct, 'total_questions' => $total, 'passed' => $score >= $mockTest->passing_score]]);
    }

    public function attempts(Request $request): JsonResponse
    {
        $attempts = $request->user()->mockTestAttempts()->with('mockTest')->latest()->paginate(20);

        return response()->json(['success' => true, 'data' => $attempts->getCollection()->map(fn (MockTestAttempt $attempt) => ['id' => $attempt->id, 'test_title' => $attempt->mockTest?->title, 'score' => $attempt->score, 'submitted_at' => optional($attempt->submitted_at)->toIso8601String()])]);
    }

    private function summary(MockTest $test): array
    {
        return ['id' => $test->id, 'course_id' => $test->course_id, 'title' => $test->title, 'description' => $test->description, 'duration_minutes' => $test->duration_minutes, 'passing_score' => $test->passing_score, 'questions_count' => $test->questions_count ?? $test->questions()->count()];
    }
}
