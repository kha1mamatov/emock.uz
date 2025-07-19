<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\MockTest;
use App\Models\OneSkillResult;
use App\Models\WritingAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GroqIELTSEvaluator;

class TestDeliveryController extends Controller
{
    public function show($id)
    {
        $test = MockTest::findOrFail($id);
        return view($test->task_type === 'task_1' ? 'test.writing.task1' : 'test.writing.task2', compact('test'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $test = MockTest::findOrFail($request->mock_test_id);

        // Evaluate using Groq
        $evaluator = new GroqIELTSEvaluator();
        $aiResult = $evaluator->evaluate("$test->prompt\n\n$request->answer");

        if (!$aiResult || !is_array($aiResult)) {
            return back()->with('error', 'AI evaluation failed. Please try again.');
        }

        // Store score and feedback
        $result = OneSkillResult::create([
            'user_id' => $user->id,
            'mock_test_id' => $test->id,
            'skill' => 'writing',
            'status' => 'reviewed',
            'band_score' => $this->calculateOverallScore($aiResult),
            'task_response' => $aiResult['task_response'] ?? null,
            'coherence_cohesion' => $aiResult['coherence_cohesion'] ?? null,
            'vocabulary' => $aiResult['lexical_resource'] ?? null,
            'grammar' => $aiResult['grammatical_range_and_accuracy'] ?? null,
            'evaluation' => [
                'summary' => $aiResult['summary'] ?? null,
                'general_feedback' => $aiResult['general_feedback'] ?? null,
                'task_response_feedback' => $aiResult['task_response_feedback'] ?? null,
                'coherence_cohesion_feedback' => $aiResult['coherence_cohesion_feedback'] ?? null,
                'vocabulary_feedback' => $aiResult['lexical_resource_feedback'] ?? null,
                'grammar_feedback' => $aiResult['grammatical_range_and_accuracy_feedback'] ?? null,
            ],
        ]);

        // Store writing answer
        WritingAnswer::create([
            'one_skill_result_id' => $result->id,
            'answer' => $request->answer,
            'word_count' => str_word_count($request->answer),
        ]);

        return redirect()->route('dashboard.history')->with('message', 'Result submitted and evaluated successfully.');
    }

    public function result($id)
    {
        $result = OneSkillResult::with(['test', 'writingAnswer'])->findOrFail($id);

        return response()->json([
            'mock_test_id' => $result->mock_test_id,
            'skill' => $result->skill,
            'status' => $result->status,
            'band_score' => $result->band_score,
            'submitted_at' => $result->created_at->toDateTimeString(),

            'test_details' => [
                'title' => $result->test->title,
                'prompt' => $result->test->prompt,
                'model_answer' => $result->test->model_answer,
                'task_type' => $result->test->task_type,
                'categories' => $result->test->categories,
            ],

            'answer_details' => [
                'answer' => optional($result->writingAnswer)->answer,
                'word_count' => optional($result->writingAnswer)->word_count,
                'submitted_at' => optional($result->writingAnswer)->created_at?->toDateTimeString(),
            ],

            'criteria' => [
                'task_response' => $result->task_response,
                'coherence_cohesion' => $result->coherence_cohesion,
                'vocabulary' => $result->vocabulary,
                'grammar' => $result->grammar,
            ],

            'evaluation' => [
                'summary' => $result->evaluation['summary'] ?? null,
                'general_feedback' => $result->evaluation['general_feedback'] ?? null,
                'task_response_feedback' => $result->evaluation['task_response_feedback'] ?? null,
                'coherence_cohesion_feedback' => $result->evaluation['coherence_cohesion_feedback'] ?? null,
                'vocabulary_feedback' => $result->evaluation['vocabulary_feedback'] ?? null,
                'grammar_feedback' => $result->evaluation['grammar_feedback'] ?? null,
            ],
        ]);
    }

    // Helper to calculate band score (average of 4 criteria, rounded to nearest 0.5)
    protected function calculateOverallScore(array $result): float
    {
        $scores = [
            $result['task_response'] ?? 0,
            $result['coherence_cohesion'] ?? 0,
            $result['lexical_resource'] ?? 0,
            $result['grammatical_range_and_accuracy'] ?? 0,
        ];

        $validScores = array_filter($scores, fn($score) => is_numeric($score));
        if (count($validScores) !== 4) return 0;

        $avg = array_sum($validScores) / 4;
        return round($avg * 2) / 2; // Round to nearest 0.5
    }
}
