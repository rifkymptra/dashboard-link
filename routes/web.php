<?php

use App\Models\Link;
use App\Models\Section;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['admin'])->group(function () {
    Route::get('link/approval', [LinkController::class, 'approval'])->name('links.approval');
    Route::post('/link/approval/{id}/accept', [LinkController::class, 'accept'])->name('approval.accept');
    Route::post('/link/approval/{id}/reject', [LinkController::class, 'reject'])->name('approval.reject');
    Route::get('/approval/search', [LinkController::class, 'searchApproval'])->name('approval.search');
    Route::get('/links/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');

    Route::get('users/kelola', [UserController::class, 'kelolaUser'])->name('users.kelola');
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');

    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/{type}', [ReportController::class, 'getReport']);
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');

    Route::get('/link', [LinkController::class, 'index'])->name('links.index');
    Route::get('/link/search', [LinkController::class, 'search'])->name('links.search');
    Route::get('/link/create', [LinkController::class, 'create'])->name('links.create');
    Route::post('/link', [LinkController::class, 'store'])->name('links.store');

    // Rute untuk memperbarui link
    Route::put('/links/update', [LinkController::class, 'update'])->name('links.update');
    // Route::get('/link/manage', [LinkController::class, 'index'])->name('links.index');

    Route::get('export-links', [LinkController::class, 'export']);

    Route::get('/pengajuan', [LinkController::class, 'approvalUser'])->name('approvaluser');

    // Logout route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__ . '/auth.php';
