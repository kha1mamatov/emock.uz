<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\OneSkillResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        $reviews = OneSkillResult::where('is_manual', true)
            ->where('is_reviewed', true)
            ->where('reviewed_by', $teacherId);

        $totalReviewed = $reviews->count();
        $pending = OneSkillResult::where('requires_manual_review', true)
            ->where('is_reviewed', false)
            ->count();

        $skillCounts = $reviews->select('skill', DB::raw('COUNT(*) as count'))
            ->groupBy('skill')
            ->pluck('count', 'skill');

        $dailyActivity = $reviews->selectRaw("DATE(updated_at) as date, COUNT(*) as count")
            ->where('updated_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $recent = $reviews->with('user', 'test')->latest('updated_at')->take(5)->get();
        $pendingReviews = OneSkillResult::with('user', 'test')
            ->where('requires_manual_review', true)
            ->where('is_reviewed', false)
            ->latest()
            ->take(5)
            ->get();
        $reviewedToday = OneSkillResult::where('is_reviewed', true)->whereDate('updated_at', today())->count();

        return view('teacher.dashboard', [
            'totalReviewed' => $totalReviewed,
            'pending' => $pending,
            'skillLabels' => $skillCounts->keys(),
            'skillData' => $skillCounts->values(),
            'activityLabels' => $dailyActivity->pluck('date')->map(fn($d) => date('M d', strtotime($d))),
            'activityData' => $dailyActivity->pluck('count'),
            'recentReviews' => $recent,
            'pendingReviews' => $pendingReviews,
            'reviewedToday' => $reviewedToday
        ]);
    }
}
