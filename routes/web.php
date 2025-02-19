<?php

use App\Http\Middleware\RedirectIfLogin;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('login');
})->name('login')->middleware(RedirectIfLogin::class);

Route::view('allposts','allposts')->middleware(ValidUser::class)->name('allposts');
Route::view('addpost','addpost')->middleware(ValidUser::class);
