<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Lista todos os álbuns.
     */
    public function index()
    {
        $albums = Album::all();

        return response()->json($albums, 200);
    }

    /**
     * Cadastra um novo álbum.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'artist_id' => 'required|integer|exists:artists,id',
            'title' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1|max:9999',
            'cover_image' => 'nullable|string|max:255',
        ]);

        $album = Album::create($data);

        return response()->json($album, 201);
    }

    /**
     * Exibe um álbum com seu artista e suas músicas.
     */
    public function show($id)
    {
        $album = Album::with(['artist', 'songs'])
            ->findOrFail($id);

        return response()->json($album, 200);
    }

    /**
     * Atualiza um álbum existente.
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $data = $request->validate([
            'artist_id' => 'sometimes|required|integer|exists:artists,id',
            'title' => 'sometimes|required|string|max:255',
            'release_year' => 'sometimes|required|integer|min:1|max:9999',
            'cover_image' => 'sometimes|nullable|string|max:255',
        ]);

        $album->update($data);

        return response()->json($album, 200);
    }

    /**
     * Exclui um álbum.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        $album->delete();

        return response()->json([
            'message' => 'Álbum excluído com sucesso.'
        ], 200);
    }
}