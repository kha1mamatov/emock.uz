<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OneSkillResult;
use App\Notifications\TestReviewed;

class ReviewController extends Controller
{
    // Show all writing/speaking results needing review
    public function index()
    {
        $results = OneSkillResult::with('user')
            ->whereIn('skill', ['writing', 'speaking'])
            ->whereNull('band_score') // only unreviewed
            ->latest()
            ->get();

        return view('teacher.reviews.index', compact('results'));
    }

    // Show individual result
    public function show($id)
    {
        $result = OneSkillResult::with(['user', 'writingAnswer'])->findOrFail($id);

        return view('teacher.reviews.show', compact('result'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'band_score' => 'required|numeric|min:0|max:9',
            'feedback' => 'nullable|string|max:2000',
        ]);

        $result = OneSkillResult::findOrFail($id);
        $result->band_score = $validated['band_score'];
        $result->feedback = $validated['feedback'];
        $result->save();

        $result->user->notify(new TestReviewed($result));

        return redirect()->route('teacher.reviews.index')->with('status', 'Review submitted and user notified.');
    }
}
