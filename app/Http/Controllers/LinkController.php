<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Section;
use App\Exports\LinkExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LinkController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $links = Link::where('status', 'approved')->paginate(10);
        return view('link', compact('links', 'sections'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $sectionIds = $request->input('sections', []);

        $links = Link::where('status', 'approved')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q) use ($query) {
                    $q->where('link_name', 'like', "%$query%")
                        ->orWhere('description_link', 'like', "%$query%")
                        ->orWhere('url', 'like', "%$query%")
                        ->orWhereHas('submittedBy.section', function ($q) use ($query) {
                            $q->where('section_name', 'like', "%$query%");
                        });
                });
            })
            ->when($sectionIds, function ($q) use ($sectionIds) {
                $q->whereHas('submittedBy.section', function ($q) use ($sectionIds) {
                    $q->whereIn('id', $sectionIds);
                });
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
        $sections = Section::all();
        return view('create-link', compact('sections'));
    }

    // Menyimpan link ke database
    public function store(Request $request)
    {
        $request->validate([
            'link_name' => 'required|string|max:255',
            'url' => 'required|url',
            'description_link' => 'required|string',
            'vpn' => 'required|boolean',
            'section_id' => 'required|exists:sections,id'
        ]);
        try {
            Link::create([
                'link_name' => $request->link_name,
                'url' => $request->url,
                'description_link' => $request->description_link,
                'vpn' => $request->vpn ? true : false,
                'section_id' => $request->section_id, // Assuming section_id is from the logged-in user
                'submitted_by' => '1',
                'status' => 'submitted',
            ]);

            return redirect()->route('links.create')->with('success', 'Link berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->route('links.create')->with('error', 'Link gagal diajukan: ' . $e->getMessage());
        }
    }

    public function approval()
    {
        $links = Link::where('status', 'submitted')->paginate(10);
        return view('approval', compact('links'));
    }

    // Mengubah status link menjadi approved
    public function accept($id)
    {
        $link = Link::findOrFail($id);
        $link->status = 'approved';
        $link->save();

        return redirect()->route('links.approval')->with('Sukses', 'Link berhasil diterima!');
    }

    // Mengubah status link menjadi rejected
    public function reject($id)
    {
        $link = Link::findOrFail($id);
        $link->status = 'rejected';
        $link->save();

        return redirect()->route('links.approval')->with('Sukses', 'Link berhasil ditolak!');
    }

    public function export()
    {
        $links = Link::with('submittedBy.section')->get(); // Ambil data link
        $export = new LinkExport($links);
        $filepath = $export->export();

        return response()->download($filepath)->deleteFileAfterSend(true);
    }
}
