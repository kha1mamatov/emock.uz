<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\MockTestResult;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Load all tests once
        $tests = MockTestResult::where('user_id', $user->id)->get();

        $totalTests = $tests->count();
        $highestScore = $tests->max('score');
        $averageScore = round($tests->avg('score'), 1);
        $latestScore = optional($tests->first())->score; // only useful if tests are sorted (optional)

        // Skill averages
        $skillAverages = $this->calculateSkillAverages($tests);

        // Skill counts
        $skillCounts = $this->countSkillAttempts($tests);

        // Most practiced skill
        $topSkill = collect($skillCounts)->sortDesc()->keys()->first();

        // Login logs (limit to 15)
        $logins = $user->loginLogs()->latest()->take(15)->get();

        return view('dashboard.profile', compact(
            'user',
            'totalTests',
            'highestScore',
            'averageScore',
            'skillAverages',
            'topSkill',
            'logins'
        ));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        // Viewer profile should not expose private test info
        return view('dashboard.profile', compact('user'))->with([
            'highestScore' => null,
            'totalTests' => null,
            'averageScore' => null,
            'skillAverages' => null,
            'topSkill' => null,
            'logins' => collect(),
        ]);
    }

    // ----------------------------
    // 🔧 Utility Functions
    // ----------------------------

    private function calculateSkillAverages($tests)
    {
        return [
            round($tests->avg('listening_score') ?? 0, 1),
            round($tests->avg('reading_score') ?? 0, 1),
            round($tests->avg('writing_score') ?? 0, 1),
            round($tests->avg('speaking_score') ?? 0, 1),
        ];
    }

    private function countSkillAttempts($tests)
    {
        return [
            'listening' => $tests->whereNotNull('listening_score')->count(),
            'reading'   => $tests->whereNotNull('reading_score')->count(),
            'writing'   => $tests->whereNotNull('writing_score')->count(),
            'speaking'  => $tests->whereNotNull('speaking_score')->count(),
        ];
    }
}
