<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Masoudi\Laravel\Visitors\Models\Visitor;

class VisitController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $startOfYear = Carbon::now()->startOfYear()->toDateString();

        $dailyVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->whereDate('created_at', $today)
            ->groupBy('date')
            ->get();

        $weeklyVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->whereBetween('created_at', [$startOfWeek, $today])
            ->groupBy('date')
            ->get();

        $weeklyVisitors = count($weeklyVisitors);

        $monthlyVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->whereBetween('created_at', [$startOfMonth, $today])
            ->groupBy('date')
            ->get();

        $yearlyVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->whereBetween('created_at', [$startOfYear, $today])
            ->groupBy('date')
            ->get();

        return view('visits', compact('dailyVisitors', 'weeklyVisitors', 'monthlyVisitors', 'yearlyVisitors'));
    }
}
