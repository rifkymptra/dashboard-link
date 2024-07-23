<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::paginate(10);
        return view('links.index', compact('links'));
    }

    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $links = Link::paginate(10);
            return view('links.pagination', compact('links'))->render();
        }
    }
}
