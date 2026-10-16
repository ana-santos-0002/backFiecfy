<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $albums = [
            // ROCK — QUEEN
            ['artist' => 'Queen', 'title' => 'A Night at the Opera', 'year' => 1975],
            ['artist' => 'Queen', 'title' => 'A Day at the Races', 'year' => 1976],
            ['artist' => 'Queen', 'title' => 'Jazz', 'year' => 1978],
            ['artist' => 'Queen', 'title' => 'The Game', 'year' => 1980],

            // ROCK — LED ZEPPELIN
            ['artist' => 'Led Zeppelin', 'title' => 'Led Zeppelin IV', 'year' => 1971],
            ['artist' => 'Led Zeppelin', 'title' => 'Led Zeppelin II', 'year' => 1969],
            ['artist' => 'Led Zeppelin', 'title' => 'Physical Graffiti', 'year' => 1975],

            // ROCK — NIRVANA
            ['artist' => 'Nirvana', 'title' => 'Nevermind', 'year' => 1991],
            ['artist' => 'Nirvana', 'title' => 'In Utero', 'year' => 1993],
            ['artist' => 'Nirvana', 'title' => 'Bleach', 'year' => 1989],

            // ROCK — GUNS N ROSES
            ['artist' => 'Guns N Roses', 'title' => 'Appetite for Destruction', 'year' => 1987],
            ['artist' => 'Guns N Roses', 'title' => 'Use Your Illusion I', 'year' => 1991],
            ['artist' => 'Guns N Roses', 'title' => 'Use Your Illusion II', 'year' => 1991],

            // ROCK — AC/DC
            ['artist' => 'AC/DC', 'title' => 'Back in Black', 'year' => 1980],
            ['artist' => 'AC/DC', 'title' => 'The Razors Edge', 'year' => 1990],
            ['artist' => 'AC/DC', 'title' => 'Highway to Hell', 'year' => 1979],

            // ROCK — THE BEATLES
            ['artist' => 'The Beatles', 'title' => 'Please Please Me', 'year' => 1963],
            ['artist' => 'The Beatles', 'title' => 'Magical Mystery Tour', 'year' => 1967],
            ['artist' => 'The Beatles', 'title' => 'Help!', 'year' => 1965],
            ['artist' => 'The Beatles', 'title' => 'Abbey Road', 'year' => 1969],

            // ROCK — PINK FLOYD
            ['artist' => 'Pink Floyd', 'title' => 'Wish You Were Here', 'year' => 1975],
            ['artist' => 'Pink Floyd', 'title' => 'The Wall', 'year' => 1979],
            ['artist' => 'Pink Floyd', 'title' => 'The Dark Side of the Moon', 'year' => 1973],

            // ROCK — THE CURE
            ['artist' => 'The Cure', 'title' => 'Disintegration', 'year' => 1989],
            ['artist' => 'The Cure', 'title' => 'Wish', 'year' => 1992],
            ['artist' => 'The Cure', 'title' => 'Three Imaginary Boys', 'year' => 1979],

            // ROCK — WHITESNAKE
            ['artist' => 'Whitesnake', 'title' => 'Whitesnake', 'year' => 1987],

            // ROCK — DEF LEPPARD
            ['artist' => 'Def Leppard', 'title' => 'Hysteria', 'year' => 1987],

            // ROCK — BON JOVI
            ['artist' => 'Bon Jovi', 'title' => 'Slippery When Wet', 'year' => 1986],
            ['artist' => 'Bon Jovi', 'title' => 'Crush', 'year' => 2000],

            // POP — TAYLOR SWIFT
            ['artist' => 'Taylor Swift', 'title' => 'Fearless', 'year' => 2008],
            ['artist' => 'Taylor Swift', 'title' => '1989', 'year' => 2014],
            ['artist' => 'Taylor Swift', 'title' => 'Red', 'year' => 2012],

            // POP — LADY GAGA
            ['artist' => 'Lady Gaga', 'title' => 'The Fame Monster', 'year' => 2009],
            ['artist' => 'Lady Gaga', 'title' => 'The Fame', 'year' => 2008],

            // POP — BRUNO MARS
            ['artist' => 'Bruno Mars', 'title' => 'Doo-Wops & Hooligans', 'year' => 2010],
            ['artist' => 'Bruno Mars', 'title' => 'Unorthodox Jukebox', 'year' => 2012],

            // POP — JUSTIN BIEBER
            ['artist' => 'Justin Bieber', 'title' => 'Purpose', 'year' => 2015],
            ['artist' => 'Justin Bieber', 'title' => 'Believe', 'year' => 2012],

            // POP — KATY PERRY
            ['artist' => 'Katy Perry', 'title' => 'Teenage Dream', 'year' => 2010],
        ];

        foreach ($albums as $album) {
            $artistId = DB::table('artists')
                ->where('name', $album['artist'])
                ->value('id');

            if (!$artistId) {
                throw new \RuntimeException(
                    "Artista '{$album['artist']}' não encontrado. Execute ArtistsSeeder primeiro."
                );
            }

            DB::table('albums')->updateOrInsert(
                [
                    'artist_id' => $artistId,
                    'title' => $album['title'],
                ],
                [
                    'release_year' => $album['year'],
                    'cover_image' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
