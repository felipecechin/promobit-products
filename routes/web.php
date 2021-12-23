<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['login' => true,
    'logout' => true,
    'register' => true,
    'reset' => false,   // for resetting passwords
    'confirm' => false,  // for additional password confirmations
    'verify' => false,  // for email verification
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/tag', TagController::class)->except(['create', 'show'])->middleware('auth');
Route::resource('/product', ProductController::class)->except(['create', 'show'])->middleware('auth');
