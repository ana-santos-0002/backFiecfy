<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     *Lista todas as músicas.
    
    *public function index()
    *   {
    *       $songs = Song::all();
    *
    *       return response()->json($songs, 200);
    *   }
     */

    /**
     * Cadastra uma nova música.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => 'required|integer|exists:albums,id',
            'title' => 'required|string|max:255',
            'duration_seconds' => 'required|integer|min:1',
            'track_number' => 'sometimes|integer|min:1',
            'is_explicit' => 'sometimes|boolean',
            'audio_path' => 'nullable|string|max:255',
        ]);

        $song = Song::create($data);

        return response()->json($song, 201);
    }

    /**
     * Exibe uma música com seu álbum.
     */
    public function show($id)
    {
        $song = Song::with('album')->findOrFail($id);

        return response()->json($song, 200);
    }

    /**
     * Atualiza uma música existente.
     */
    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $data = $request->validate([
            'album_id' => 'sometimes|required|integer|exists:albums,id',
            'title' => 'sometimes|required|string|max:255',
            'duration_seconds' => 'sometimes|required|integer|min:1',
            'track_number' => 'sometimes|integer|min:1',
            'is_explicit' => 'sometimes|boolean',
            'audio_path' => 'sometimes|nullable|string|max:255',
        ]);

        $song->update($data);

        return response()->json($song, 200);
    }

    /**
     * Exclui uma música.
     */
    public function destroy($id)
    {
        $song = Song::findOrFail($id);

        $song->delete();

        return response()->json([
            'message' => 'Música excluída com sucesso.'
        ], 200);
    }

    /*****************************/

    //listar todas as músicas
    public function index (Request $request){
        $musicas = [
    ['title' => 'Back in Black', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Thunderstruck', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Highway to Hell', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Hells Bells', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'You Shook Me All Night Long', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'T.N.T.', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Shoot to Thrill', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Dirty Deeds Done Dirt Cheap', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Rock or Bust', 'artist' => 'AC/DC', 'genre' => 'Rock'],
    ['title' => 'Whole Lotta Rosie', 'artist' => 'AC/DC', 'genre' => 'Rock'],

    // 5 músicas de Rock — Queen
    ['title' => 'Bohemian Rhapsody', 'artist' => 'Queen', 'genre' => 'Rock'],
    ['title' => 'We Will Rock You', 'artist' => 'Queen', 'genre' => 'Rock'],
    ['title' => 'Another One Bites the Dust', 'artist' => 'Queen', 'genre' => 'Rock'],
    ['title' => 'Dont Stop Me Now', 'artist' => 'Queen', 'genre' => 'Rock'],
    ['title' => 'Somebody to Love', 'artist' => 'Queen', 'genre' => 'Rock'],

    // 5 músicas de outros gêneros
    ['title' => 'Billie Jean', 'artist' => 'Michael Jackson', 'genre' => 'Pop'],
    ['title' => 'Like a Prayer', 'artist' => 'Madonna', 'genre' => 'Pop'],
    ['title' => 'Imagine', 'artist' => 'John Lennon', 'genre' => 'Pop'],
    ['title' => 'Smells Like Teen Spirit', 'artist' => 'Nirvana', 'genre' => 'Grunge'],
    ['title' => 'Hotel California', 'artist' => 'Eagles', 'genre' => 'Country Rock'],
];
    return response()->json($musicas);
    }
}