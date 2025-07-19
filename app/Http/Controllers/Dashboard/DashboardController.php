<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OneSkillResult;
use App\Models\MockTest;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $results = OneSkillResult::with('test')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $recentResults = $results->take(6);
        $writingResults = $results;

        return view('dashboard.dashboard', [
            'user' => $user,
            'totalTests' => $results->count(),
            'averageScore' => round($results->avg('band_score') ?? 0, 1),
            'latestScore' => $recentResults->first()?->band_score ?? 'N/A',
            'recentTests' => $recentResults,
            'scoreMonths' => $recentResults->pluck('created_at')->map(fn($d) => $d->format('M'))->toArray(),
            'scoreValues' => $recentResults->pluck('band_score')->toArray(),
            'scoreChange' => $this->getScoreChange($recentResults),

            'personalRecords' => [
                'highest_overall' => $results->max('band_score') ?? 'N/A',
                'writing' => $writingResults->max('band_score') ?? '—',
            ],

            'writingTypes' => ['Task 1', 'Task 2'],
            'writingCounts' => [
                $writingResults->where('task_type', 'task_1')->count(),
                $writingResults->where('task_type', 'task_2')->count(),
            ],

            'activityLabels' => $this->getActivityLabels($results),
            'activityCounts' => $this->getActivityCounts($results),
        ]);
    }

    private function getScoreChange($results)
    {
        if ($results->count() < 2)
            return 0;
        return round($results->first()->band_score - $results->last()->band_score, 2);
    }

    private function getActivityLabels($results)
    {
        return $results->filter(fn($r) => $r->created_at >= now()->subMonths(6))
            ->groupBy(fn($r) => $r->created_at->format('Y-m-d'))
            ->keys()
            ->map(fn($d) => date('M d', strtotime($d)))
            ->values();
    }

    private function getActivityCounts($results)
    {
        return $results->filter(fn($r) => $r->created_at >= now()->subMonths(6))
            ->groupBy(fn($r) => $r->created_at->format('Y-m-d'))
            ->map(fn($g) => count($g))
            ->values();
    }

    public function history()
    {
        $user = auth()->user();

        $oneSkills = OneSkillResult::with(['writingAnswer', 'test'])
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->groupBy('skill');

        return view('dashboard.history', compact('oneSkills'));
    }

    public function testListBySkill($skill)
    {
        $user = auth()->user();

        // Get all active tests of the selected skill
        $paginated = MockTest::where('skill', $skill)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        // Add user-specific data to each test
        $paginated->getCollection()->transform(function ($test) use ($user) {
            // Latest attempt on THIS specific test
            $latestAttempt = OneSkillResult::where('user_id', $user->id)
                ->where('mock_test_id', $test->id)
                ->latest()
                ->first();

            // Total attempts on this test (not by skill globally)
            $attemptCount = OneSkillResult::where('user_id', $user->id)
                ->where('mock_test_id', $test->id)
                ->count();

            $test->latest_attempt = $latestAttempt;
            $test->exceeded_limit = $attemptCount >= 1;

            return $test;
        });

        return view("dashboard.tests.writing", [
            'tests' => $paginated,
        ]);
    }

    public function writing(Request $request)
    {
        $user = auth()->user();

        $query = MockTest::query();

        // Sort logic
        switch ($request->input('sort')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'highest':
                $query->withAvg('results as avg_score', 'band_score')->orderByDesc('avg_score');
                break;
            case 'lowest':
                $query->withAvg('results as avg_score', 'band_score')->orderBy('avg_score');
                break;
            default:
                $query->latest();
                break;
        }

        $tests = $query->paginate(12);

        // Add latest attempt per user
        $tests->getCollection()->transform(function ($test) use ($user, $request) {
            $latestAttempt = OneSkillResult::where('user_id', $user->id)
                ->where('mock_test_id', $test->id)
                ->latest()
                ->first();

            // Filter by status (after attaching attempt)
            if ($request->filled('status') && optional($latestAttempt)->status !== $request->input('status')) {
                return null; // Exclude
            }

            $test->latest_attempt = $latestAttempt;
            return $test;
        });

        // Filter out nulls after transformation
        $tests->setCollection($tests->getCollection()->filter());

        return view('dashboard.tests.writing', compact('tests'));
    }

    public function speaking()
    {
        return $this->testListBySkill('speaking');
    }

    public function leaderboard()
    {
        $users = User::withCount([
            'oneSkillResults as total_tests'
        ])
            ->select('id', 'name')
            ->withAvg('oneSkillResults as average_score', 'band_score')
            ->whereHas('oneSkillResults')
            ->orderByDesc('average_score')
            ->take(20)
            ->get();

        return view('dashboard.leaderboard', compact('users'));
    }

    // ✅ Bonus (future): You can add filters, analytics, or feedback-based charts here

    public function view($id)
    {
        $result = OneSkillResult::with(['writingAnswer', 'test'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('dashboard.view', compact('result'));
    }
}
