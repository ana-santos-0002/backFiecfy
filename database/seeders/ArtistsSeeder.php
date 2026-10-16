<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $artists = [
            ['name' => 'Queen', 'genre' => 'Rock'],
            ['name' => 'Nirvana', 'genre' => 'Grunge'],
            ['name' => 'Taylor Swift', 'genre' => 'Pop'],
            ['name' => 'The Beatles', 'genre' => 'Rock'],
            ['name' => 'Pink Floyd', 'genre' => 'Progressive Rock'],
            ['name' => 'AC/DC', 'genre' => 'Hard Rock'],
            ['name' => 'Bon Jovi', 'genre' => 'Rock'],
            ['name' => 'Lady Gaga', 'genre' => 'Pop'],
            ['name' => 'Bruno Mars', 'genre' => 'Pop'],
            ['name' => 'Justin Bieber', 'genre' => 'Pop'],
            ['name' => 'Katy Perry', 'genre' => 'Pop'],
            ['name' => 'Led Zeppelin', 'genre' => 'Hard Rock'],
            ['name' => 'Guns N Roses', 'genre' => 'Hard Rock'],
            ['name' => 'The Cure', 'genre' => 'Alternative Rock'],
            ['name' => 'Whitesnake', 'genre' => 'Hard Rock'],
            ['name' => 'Def Leppard', 'genre' => 'Hard Rock'],
        ];

        foreach ($artists as $artist) {
            DB::table('artists')->updateOrInsert(
                ['name' => $artist['name']],
                [
                    'genre' => $artist['genre'],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
