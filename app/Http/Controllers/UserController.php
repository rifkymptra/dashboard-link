<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profileShow()
    {
        return view('profile');
    }

    public function create()
    {
        $sections = Section::all();
        return view('createuser', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'section_id' => 'required|exists:sections,id',
            'role' => 'required|in:user,admin',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'section_id' => $request->section_id,
                'role' => $request->role,
            ]);

            return redirect()->route('beranda')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat akun.']);
        }
    }

    public function kelolaUser()
    {
        $users = User::paginate(10);
        $sections = Section::all();
        return view('kelolauser', compact('users', 'sections'));
    }

    // Menampilkan form untuk mengedit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $sections = Section::all();

        // Mengembalikan data dalam format JSON untuk AJAX
        return response()->json([
            'user' => $user,
            'sections' => $sections,
        ]);
    }

    // Memperbarui user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->section_id = $request->input('section_id');
        $user->role = $request->input('role');
        $user->save();

        return response()->json(['success' => true]);
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.kelola')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('role', 'like', "%$query%")
            ->orWhereHas('section', function ($q) use ($query) {
                $q->where('section_name', 'like', "%$query%");
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.users', compact('users'))->render();
        }

        return view('kelolauser', compact('users'));
    }
}
