<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Masoudi\Laravel\Visitors\Models\Visitor;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports');
    }
    public function getReport($type)
    {
        $data = [];

        if ($type === 'daily') {
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $data = Visitor::whereBetween('created_at', [$startDate, $endDate])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(distinct ip) as count'))
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();
        } elseif ($type === 'monthly') {
            $startDate = Carbon::now()->subDays(29)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $data = Visitor::whereBetween('created_at', [$startDate, $endDate])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(distinct ip) as count'))
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();
        } elseif ($type === 'yearly') {
            $startDate = Carbon::now()->subYear()->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $data = Visitor::whereBetween('created_at', [$startDate, $endDate])
                ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(distinct ip) as count'))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();
        }

        return view('components.report-table', compact('data', 'type'));
    }
}
