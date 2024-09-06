<?php

namespace App\View\Components;

use Closure;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Masoudi\Laravel\Visitors\Models\Visitor;

class VisitorReport extends Component
{
    public $todayCount;
    public $weekCount;
    public $monthCount;
    public $yearCount;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $today = Carbon::now()->toDateString();
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $startOfYear = Carbon::now()->startOfYear()->toDateString();
        $nextDay = Carbon::now()->addDay()->toDateString();

        // Hitung jumlah pengunjung hari ini
        $this->todayCount = Visitor::whereDate('created_at', $today)
            ->distinct('ip')
            ->count();

        // Hitung jumlah pengunjung minggu ini
        $this->weekCount = $this->calculateUniqueVisitors($startOfWeek, $nextDay);

        // Hitung jumlah pengunjung bulan ini
        $this->monthCount = $this->calculateUniqueVisitors($startOfMonth, $nextDay);

        // Hitung jumlah pengunjung tahun ini
        $this->yearCount = $this->calculateUniqueVisitors($startOfYear, $nextDay);
    }

    /**
     * Calculate unique visitors within a given range.
     */
    private function calculateUniqueVisitors($startDate, $endDate)
    {
        $totalUniqueVisitors = 0;
        $currentDate = Carbon::parse($endDate);

        // Loop dari tanggal akhir hingga tanggal mulai
        while ($currentDate->greaterThanOrEqualTo($startDate)) {
            $dailyCount = Visitor::whereDate('created_at', $currentDate->toDateString())
                ->distinct('ip')
                ->count();

            $totalUniqueVisitors += $dailyCount;
            $currentDate->subDay();  // Mundur satu hari
        }

        return $totalUniqueVisitors;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visitor-report');
    }
}
