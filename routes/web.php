<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentCon;
use App\Http\Controllers\FotoCon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profil', function () {
    return view('admin.profil');
});
Route::get('/', [App\Http\Controllers\AlbumCon::class, 'landing']);
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\AlbumCon::class, 'index'])->name('dashboard');
Route::get('/album', [App\Http\Controllers\AlbumCon::class, 'album'])->name('album');
Route::post('/album-store', [App\Http\Controllers\AlbumCon::class, 'store'])->name('album.store');
Route::put('/album-update/{id}', [App\Http\Controllers\AlbumCon::class, 'update'])->name('album.update');
Route::delete('/album-delete/{id}', [App\Http\Controllers\AlbumCon::class, 'destroy'])->name('album.destroy');
Route::get('/album/foto/{id}', [App\Http\Controllers\AlbumCon::class, 'show'])->name('album.foto');
Route::post('/album/foto-store', [App\Http\Controllers\FotoCon::class, 'store'])->name('foto.store');
Route::put('/album/foto-update/{id}', [App\Http\Controllers\FotoCon::class, 'update'])->name('foto.update');
Route::delete('/album/foto-delete/{id}', [App\Http\Controllers\FotoCon::class, 'destroy'])->name('foto.destroy');
Route::post('/album/foto/like/{id}', [FotoCon::class, 'like'])->name('like');
Route::post('/album/foto/comment/{id}', [CommentCon::class, 'store'])->name('comment');
Route::delete('/album/foto/comment-delete/{id}', [CommentCon::class, 'destroy'])->name('comment.destroy');
