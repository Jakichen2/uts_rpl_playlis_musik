<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;

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


Route::resource('playlists', PlaylistController::class);
Route::delete('playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
Route::post('playlists/{playlist}/songs', [PlaylistController::class, 'addSong'])->name('playlists.addSong');
Route::post('playlists/{playlist}/updateOrder', [PlaylistController::class, 'updateOrder'])->name('playlists.updateOrder');
Route::delete('playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.removeSong');
Route::get('songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('songs', [SongController::class, 'store'])->name('songs.store');
Route::get('songs', [SongController::class, 'index'])->name('songs.index');
Route::get('songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
Route::put('songs/{song}', [SongController::class, 'update'])->name('songs.update');
Route::delete('songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
