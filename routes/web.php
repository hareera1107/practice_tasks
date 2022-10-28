<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('/posts', PostController::class);

Route::get('trash', [PostController::class, 'trash'])->name('trash')->middleware('role:super-admin');
Route::get('posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore')->middleware('role:super-admin');
Route::get('posts/forceDelete/{id}', [PostController::class, 'forceDelete'])->name('posts.forceDelete')->middleware('role:super-admin');

