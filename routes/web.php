<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PlaylistLikeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}', [ProfileController::class, 'viewProfile'])->name('users.profile');
    Route::get('/favorites', [PlaylistController::class, 'likedMusic'])->name('favorites.index');
    Route::resource('playlists', PlaylistController::class);
    Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.removeSong');
    Route::post('/playlists/{playlist}/add-song', [PlaylistController::class, 'addAlbumSongs'])->name('playlists.addAlbumSongs');
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::post('/playlists/{playlist}/add-album-songs', [PlaylistController::class, 'addAlbumSongs'])->name('playlists.addAlbumSongs');
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::post('/albums/{album}/songs', [AlbumController::class, 'addSong'])->name('albums.addSong');
    Route::resource('albums', AlbumController::class)->except(['show']);
    Route::get('/albums/search', [AlbumController::class, 'search'])->name('albums.search');
    Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
    Route::post('/songs/{song}/like', [SongController::class, 'likeSong'])->name('songs.like');
    Route::post('/songs/{song}/unlike', [SongController::class, 'unlikeSong'])->name('songs.unlike');
    // Follow/Unfollow routes
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');

    // Followers/Following lists
    Route::get('/users/{user}/followers', [FollowController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user}/following', [FollowController::class, 'following'])->name('users.following');

    // Playlist Like Routes
    Route::post('/playlists/{playlist}/like', [PlaylistLikeController::class, 'toggle'])
         ->name('playlists.like.toggle');
    Route::get('/liked-playlists', [PlaylistLikeController::class, 'index'])
         ->name('playlists.liked');
});

require __DIR__.'/auth.php';
