<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OneSkillResult;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTests = OneSkillResult::count();
        $completedTests = OneSkillResult::where('status', 'completed')->count();
        $activeUsers = User::has('oneSkillResults')->count();
        $totalUsers = User::count();

        $monthlyTestStats = OneSkillResult::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', [
            'totalTests' => $totalTests,
            'completedTests' => $completedTests,
            'activeUsers' => $activeUsers,
            'totalUsers' => $totalUsers,
            'monthlyLabels' => $monthlyTestStats->pluck('month'),
            'monthlyData' => $monthlyTestStats->pluck('count'),
        ]);
    }
}
