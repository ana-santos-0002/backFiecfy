<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Song;

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;



// ROTA PARA FILTRO - ROCK

Route::get('/songs/rock', function () {
    return Song::where('genre', 'rock')->get();
});

/*
THUNDERCLIENT:
GET http://127.0.0.1:8000/api/songs/rock
*/


// ROTA PARA BUSCA - PALAVRA CHAVE

Route::get('/songs/search', function (Request $request) {
    $term = $request->query('q', '');

    return Song::where('title', 'like', '%' . $term . '%')
        ->orWhere('artist', 'like', '%' . $term . '%')
        ->get();
});

/*
THUNDERCLIENT:
GET http://127.0.0.1:8000/api/songs/search?q=bohemian
*/


/*
ROTA - MOSTRA TUDO MAS PAGINADO
*/

Route::get('/songs/paginado', function () {
    return Song::paginate(5);
});

/*
THUNDERCLIENT:
GET http://127.0.0.1:8000/api/songs/paginado
*/


/*
ROTA COMBINANDO TUDO
*/

Route::get('/songs', function (Request $request) {
  $query = Song::query();

  if ($request->filled('genre')) {
    $query->where('genre', $request->query('genre'));
  }
  if ($request->filled('q')) {
    $term = $request->query('q');
    $query->where(function ($sub) use ($term) {
      $sub->where('title', 'like', "%$term%")
          ->orWhere('artist', 'like', "%$term%");
    });
  }
  return $query->orderBy('id')->paginate(15);
});


/*
THUNDERCLIENT:
http://127.0.0.1:8000/api/songs?genre=rock&q=bohemian&page=1
*/






























/******************************************/
/* ROTAS DE ARTISTAS */
/******************************************/

Route::prefix('artists')->group(function () {
    Route::get('/', [ArtistController::class, 'index']);
    Route::post('/', [ArtistController::class, 'store']);
    Route::get('/{id}', [ArtistController::class, 'show']);
    Route::put('/{id}', [ArtistController::class, 'update']);
    Route::patch('/{id}', [ArtistController::class, 'update']);
    Route::delete('/{id}', [ArtistController::class, 'destroy']);
});


/******************************************/
/* ROTAS DE ÁLBUNS */
/******************************************/

Route::prefix('albums')->group(function () {
    Route::get('/', [AlbumController::class, 'index']);
    Route::post('/', [AlbumController::class, 'store']);
    Route::get('/{id}', [AlbumController::class, 'show']);
    Route::put('/{id}', [AlbumController::class, 'update']);
    Route::patch('/{id}', [AlbumController::class, 'update']);
    Route::delete('/{id}', [AlbumController::class, 'destroy']);
});


/*
ROTA COM A COMBINAÇÃO DE TODOS

A listagem principal usa SongController::index().
Os filtros por gênero, palavra-chave e a paginação
devem ser implementados nesse método.
*/

Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'index']);
    Route::post('/', [SongController::class, 'store']);
    Route::get('/{id}', [SongController::class, 'show']);
    Route::put('/{id}', [SongController::class, 'update']);
    Route::patch('/{id}', [SongController::class, 'update']);
    Route::delete('/{id}', [SongController::class, 'destroy']);
});


/******************************************/
/* ROTAS DE PLAYLISTS */
/******************************************/

Route::prefix('playlists')->group(function () {
    Route::get('/', [PlaylistController::class, 'index']);
    Route::post('/', [PlaylistController::class, 'store']);
    Route::get('/{id}', [PlaylistController::class, 'show']);
    Route::put('/{id}', [PlaylistController::class, 'update']);
    Route::patch('/{id}', [PlaylistController::class, 'update']);
    Route::delete('/{id}', [PlaylistController::class, 'destroy']);
    Route::post('/{id}/songs', [PlaylistController::class, 'addSong']);
});


/******************************************/
/* ROTA DE TESTE DA API */
/******************************************/

Route::get('/health', function () {
    return response()->json([
        'status' => 'online',
        'module' => 'Spotify Core API',
    ], 200);
});



