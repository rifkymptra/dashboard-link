<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

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
}
