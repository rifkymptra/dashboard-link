<?php

use App\Models\Link;
use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/beranda', function () {
    return view('beranda', [
        'sections' => Section::all(),
        'links' => Link::all(),
        'linkNew' => Link::where('status', 'pending')->count()
    ]);
});

Route::get('/link', [LinkController::class, 'index'])->name('links.index');
Route::get('/link/search', [LinkController::class, 'search'])->name('links.search');
Route::get('/link/create', [LinkController::class, 'create'])->name('links.create');
Route::post('/link', [LinkController::class, 'store'])->name('links.store');
Route::get('link/approval', [LinkController::class, 'approval'])->name('links.approval');
Route::post('/link/approval/{id}/accept', [LinkController::class, 'accept'])->name('approval.accept');
Route::post('/link/approval/{id}/reject', [LinkController::class, 'reject'])->name('approval.reject');
// Route::get('/link/manage', [LinkController::class, 'index'])->name('links.index');

Route::get('/profile', function () {
    return view('profile', [
        'user' => auth()->user(),
        'product' => [
            'name' => 'Apple iMac 27"',
            'brand' => 'Apple',
            'price' => 2999,
            'category' => 'Electronics',
            'weight' => 15,
            'description' => 'Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US'
        ]
    ]);
});

Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

Route::get('users/kelola', [UserController::class, 'kelolaUser'])->name('users.kelolaUser');
Route::resource('users', UserController::class);

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
