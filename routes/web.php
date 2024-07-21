<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/link',  function () {
    return view('link');
});
