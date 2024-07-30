<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Redirect;

class SectionController extends Controller
{
    /**
     * Show the form for creating a new section.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('create-section'); // Pastikan view ini sesuai dengan path file blade Anda
    }

    /**
     * Store a newly created section in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
            ]);

            return Redirect::route('sections.create')->with('success', 'Seksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return Redirect::route('sections.create')->with('error', 'Gagal menambahkan seksi: ' . $e->getMessage());
        }
    }
}
