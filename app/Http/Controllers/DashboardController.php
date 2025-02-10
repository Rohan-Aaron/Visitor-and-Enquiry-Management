<?php

namespace App\Http\Controllers;
use App\Models\Visitors;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
{
    // Today's visitors count
    $todayCount = Visitors::whereDate('created_at', now()->toDateString())->count();  // Adjusted based on created_at

    // Last 7 days visitors count
    $last7Days = Visitors::whereBetween('created_at', [now()->subDays(7), now()])->count();  // Adjusted based on created_at

    // Last month's visitors count
    $lastMonth = Visitors::whereMonth('created_at', now()->subMonth()->month)->count();  // Adjusted based on created_at

    // Total visitors count
    $totalVisitors = Visitors::count();  // Count all visitors


    return view('auth.dashboard', compact('todayCount', 'last7Days', 'lastMonth', 'totalVisitors'));
}
}
