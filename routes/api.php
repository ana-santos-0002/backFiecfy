<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;

Route::prefix('artists')->group(function () {
    Route::get('/', [ArtistController::class, 'index']);
    Route::post('/', [ArtistController::class, 'store']);
    Route::get('/{id}', [ArtistController::class, 'show']);
    Route::put('/{id}', [ArtistController::class, 'update']);
    Route::patch('/{id}', [ArtistController::class, 'update']);
    Route::delete('/{id}', [ArtistController::class, 'destroy']);
});

Route::prefix('albums')->group(function () {
    Route::get('/', [AlbumController::class, 'index']);
    Route::post('/', [AlbumController::class, 'store']);
    Route::get('/{id}', [AlbumController::class, 'show']);
    Route::put('/{id}', [AlbumController::class, 'update']);
    Route::patch('/{id}', [AlbumController::class, 'update']);
    Route::delete('/{id}', [AlbumController::class, 'destroy']);
});

Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index']);
    Route::post('/', [SongController::class, 'store']);
    Route::get('/{id}', [SongController::class, 'show']);
    Route::put('/{id}', [SongController::class, 'update']);
    Route::patch('/{id}', [SongController::class, 'update']);
    Route::delete('/{id}', [SongController::class, 'destroy']);
});

Route::prefix('playlists')->group(function () {
    Route::get('/', [PlaylistController::class, 'index']);
    Route::post('/', [PlaylistController::class, 'store']);
    Route::get('/{id}', [PlaylistController::class, 'show']);
    Route::put('/{id}', [PlaylistController::class, 'update']);
    Route::patch('/{id}', [PlaylistController::class, 'update']);
    Route::delete('/{id}', [PlaylistController::class, 'destroy']);
    Route::post('/{id}/songs', [PlaylistController::class, 'addSong']);
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'online',
        'module' => 'Spotify Core API',
    ], 200);
});