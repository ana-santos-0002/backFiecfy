<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Lista TODOS os artistas.
     */

    //prestar atenção !!!
    //aqui vai ser modificado para BUSCAS, FILTROS & PAGINAÇÃO
    public function index()
    {
        $artists = Artist::all();

        return response()->json($artists, 200);
    }

    /**
     * Cadastra um novo artista.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'profile_pic_url' => 'nullable|string|max:255',
            'monthly_listeners' => 'nullable|integer|min:0',
        ]);

        $artist = Artist::create($data);

        return response()->json($artist, 201);
    }

    /**
     * Exibe um artista com seus álbuns.
     */
    public function show($id)
    {
        $artist = Artist::with('albums')->findOrFail($id);

        return response()->json($artist, 200);
    }

    /**
     * Atualiza um artista existente.
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'genre' => 'sometimes|nullable|string|max:255',
            'profile_pic_url' => 'sometimes|nullable|string|max:255',
            'monthly_listeners' => 'sometimes|integer|min:0',
        ]);

        $artist->update($data);

        return response()->json($artist, 200);
    }

    /**
     * Exclui um artista.
     */
    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);

        $artist->delete();

        return response()->json([
            'message' => 'Artista excluído com sucesso.'
        ], 200);
    }
}