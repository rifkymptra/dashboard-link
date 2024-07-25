<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');

        $links = Link::where('link_name', 'like', "%$query%")
            ->orWhere('description_link', 'like', "%$query%")
            ->orWhere('url', 'like', "%$query%")
            ->orWhereHas('submittedBy.section', function ($q) use ($query) {
                $q->where('section_name', 'like', "%$query%");
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.links', compact('links'))->render();
        }

        return view('link', compact('links'));
    }

    // Menampilkan form create link
    public function create()
    {
        return view('create-link');
    }

    // Menyimpan link ke database
    public function store(Request $request)
    {
        $request->validate([
            'link_name' => 'required|string|max:255',
            'url' => 'required|url',
            'description_link' => 'required|string',
        ]);

        Link::create([
            'link_name' => $request->link_name,
            'url' => $request->url,
            'description_link' => $request->description_link,
            'section_id' => '1', // Assuming section_id is from the logged-in user
            'submitted_by' => '1',
            'status' => 'submitted',
        ]);

        return redirect()->route('links.create')->with('Sukses', 'Link berhasil diajukan!');
    }
}
