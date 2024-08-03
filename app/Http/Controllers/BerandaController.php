<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Section;
use Carbon\Carbon;

class BerandaController extends Controller
{
    public function index()
    {
        // Data untuk grafik jumlah link berdasarkan seksi
        $sections = Section::all();
        $links = Link::all();
        $linkNew = Link::where('status', 'pending')->count();
        $linksBySection = $sections->mapWithKeys(function ($section) {
            return [$section->section_name => $section->links->count()];
        });

        // Data untuk grafik perkembangan jumlah link per bulan
        $monthlyLinkCounts = Link::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($data) {
                return [
                    'month' => Carbon::create()->month($data->month)->format('F Y'),
                    'count' => $data->count,
                ];
            });

        return view('beranda', [
            'sections' => $sections,
            'linksBySection' => $linksBySection,
            'monthlyLinkCounts' => $monthlyLinkCounts,
            'linkNew' => $linkNew,
            'links' => $links
        ]);
    }
}
