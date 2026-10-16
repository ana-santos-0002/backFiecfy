<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        // Começa buscando as músicas
        $songs = Song::query();

        // Filtro por gênero
        if ($request->filled('genre')) {
            $songs->where('genre', $request->genre);
        }

        // Busca por título ou artista
        if ($request->filled('q')) {
            $songs->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%')
                      ->orWhere('artist', 'like', '%' . $request->q . '%');
            });
        }

        // Paginação: 10 músicas por página
        return response()->json(
            $songs->orderBy('title')->paginate(10)
        );
    }
}