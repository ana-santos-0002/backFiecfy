<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Músicas que serão cadastradas.
        // O artista será associado ao primeiro álbum disponível dele.
        $songs = [
            // ROCK — QUEEN
            ['artist' => 'Queen', 'genre' => 'rock', 'title' => 'Bohemian Rhapsody', 'duration' => 355],
            ['artist' => 'Queen', 'genre' => 'rock', 'title' => 'Love of My Life', 'duration' => 219],
            ['artist' => 'Queen', 'genre' => 'rock', 'title' => 'Somebody to Love', 'duration' => 296],
            ['artist' => 'Queen', 'genre' => 'rock', 'title' => 'Crazy Little Thing Called Love', 'duration' => 163],

            // ROCK — LED ZEPPELIN
            ['artist' => 'Led Zeppelin', 'genre' => 'rock', 'title' => 'Stairway to Heaven', 'duration' => 482],
            ['artist' => 'Led Zeppelin', 'genre' => 'rock', 'title' => 'Whole Lotta Love', 'duration' => 334],
            ['artist' => 'Led Zeppelin', 'genre' => 'rock', 'title' => 'Black Dog', 'duration' => 296],

            // ROCK — NIRVANA
            ['artist' => 'Nirvana', 'genre' => 'rock', 'title' => 'Smells Like Teen Spirit', 'duration' => 301],
            ['artist' => 'Nirvana', 'genre' => 'rock', 'title' => 'Come as You Are', 'duration' => 219],
            ['artist' => 'Nirvana', 'genre' => 'rock', 'title' => 'Lithium', 'duration' => 257],

            // ROCK — GUNS N ROSES
            ['artist' => 'Guns N Roses', 'genre' => 'rock', 'title' => 'Sweet Child O Mine', 'duration' => 356],
            ['artist' => 'Guns N Roses', 'genre' => 'rock', 'title' => 'November Rain', 'duration' => 537],
            ['artist' => 'Guns N Roses', 'genre' => 'rock', 'title' => 'Welcome to the Jungle', 'duration' => 273],

            // ROCK — AC/DC
            ['artist' => 'AC/DC', 'genre' => 'rock', 'title' => 'Back in Black', 'duration' => 255],
            ['artist' => 'AC/DC', 'genre' => 'rock', 'title' => 'Thunderstruck', 'duration' => 292],
            ['artist' => 'AC/DC', 'genre' => 'rock', 'title' => 'Highway to Hell', 'duration' => 208],

            // ROCK — THE BEATLES
            ['artist' => 'The Beatles', 'genre' => 'rock', 'title' => 'Love Me Do', 'duration' => 143],
            ['artist' => 'The Beatles', 'genre' => 'rock', 'title' => 'All You Need Is Love', 'duration' => 227],
            ['artist' => 'The Beatles', 'genre' => 'rock', 'title' => 'Cant Buy Me Love', 'duration' => 133],
            ['artist' => 'The Beatles', 'genre' => 'rock', 'title' => 'Come Together', 'duration' => 259],

            // ROCK — PINK FLOYD
            ['artist' => 'Pink Floyd', 'genre' => 'rock', 'title' => 'Wish You Were Here', 'duration' => 334],
            ['artist' => 'Pink Floyd', 'genre' => 'rock', 'title' => 'Another Brick in the Wall', 'duration' => 238],
            ['artist' => 'Pink Floyd', 'genre' => 'rock', 'title' => 'Comfortably Numb', 'duration' => 384],

            // ROCK — THE CURE
            ['artist' => 'The Cure', 'genre' => 'rock', 'title' => 'Love Song', 'duration' => 214],
            ['artist' => 'The Cure', 'genre' => 'rock', 'title' => 'Friday Im in Love', 'duration' => 214],
            ['artist' => 'The Cure', 'genre' => 'rock', 'title' => 'Boys Dont Cry', 'duration' => 156],

            // ROCK — WHITESNAKE
            ['artist' => 'Whitesnake', 'genre' => 'rock', 'title' => 'Is This Love', 'duration' => 275],

            // ROCK — DEF LEPPARD
            ['artist' => 'Def Leppard', 'genre' => 'rock', 'title' => 'Love Bites', 'duration' => 348],

            // ROCK — BON JOVI
            ['artist' => 'Bon Jovi', 'genre' => 'rock', 'title' => 'Livin on a Prayer', 'duration' => 249],
            ['artist' => 'Bon Jovi', 'genre' => 'rock', 'title' => 'Its My Life', 'duration' => 224],

            // POP — TAYLOR SWIFT
            ['artist' => 'Taylor Swift', 'genre' => 'pop', 'title' => 'Love Story', 'duration' => 236],
            ['artist' => 'Taylor Swift', 'genre' => 'pop', 'title' => 'Blank Space', 'duration' => 231],
            ['artist' => 'Taylor Swift', 'genre' => 'pop', 'title' => 'Shake It Off', 'duration' => 219],

            // POP — LADY GAGA
            ['artist' => 'Lady Gaga', 'genre' => 'pop', 'title' => 'Bad Romance', 'duration' => 295],
            ['artist' => 'Lady Gaga', 'genre' => 'pop', 'title' => 'Poker Face', 'duration' => 238],

            // POP — BRUNO MARS
            ['artist' => 'Bruno Mars', 'genre' => 'pop', 'title' => 'Just the Way You Are', 'duration' => 221],
            ['artist' => 'Bruno Mars', 'genre' => 'pop', 'title' => 'When I Was Your Man', 'duration' => 213],

            // POP — JUSTIN BIEBER
            ['artist' => 'Justin Bieber', 'genre' => 'pop', 'title' => 'Love Yourself', 'duration' => 234],
            ['artist' => 'Justin Bieber', 'genre' => 'pop', 'title' => 'Sorry', 'duration' => 201],

            // POP — KATY PERRY
            ['artist' => 'Katy Perry', 'genre' => 'pop', 'title' => 'Firework', 'duration' => 228],
        ];

        foreach ($songs as $index => $song) {
            $albumId = DB::table('albums')
                ->join('artists', 'artists.id', '=', 'albums.artist_id')
                ->where('artists.name', $song['artist'])
                ->value('albums.id');

            if (!$albumId) {
                throw new \RuntimeException(
                    "Nenhum álbum encontrado para o artista '{$song['artist']}'. Confira os registros existentes."
                );
            }

            DB::table('songs')->updateOrInsert(
                [
                    'album_id' => $albumId,
                    'title' => $song['title'],
                ],
                [
                    'artist' => $song['artist'],
                    'genre' => $song['genre'],
                    'duration_seconds' => $song['duration'],
                    'track_number' => ($index % 10) + 1,
                    'is_explicit' => false,
                    'audio_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
