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
        $nextDay = Carbon::parse($today)->addDay()->toDateString();

        // Hitung jumlah pengunjung hari ini
        $this->todayCount = Visitor::whereDate('created_at', $today)
            ->distinct('ip')
            ->count();

        // Hitung jumlah pengunjung minggu ini
        $this->weekCount = Visitor::whereBetween('created_at', [$startOfWeek, $nextDay])
            ->distinct('ip')
            ->count();

        // Hitung jumlah pengunjung bulan ini
        $this->monthCount = Visitor::whereBetween('created_at', [$startOfMonth, $nextDay])
            ->distinct('ip')
            ->count();

        // Hitung jumlah pengunjung tahun ini
        $this->yearCount = Visitor::whereBetween('created_at', [$startOfYear, $nextDay])
            ->distinct('ip')
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visitor-report');
    }
}
