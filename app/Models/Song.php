<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    protected $fillable = [
        'album_id',
        'title',
        'duration_seconds',
        'track_number',
        'is_explicit',
        'audio_path',
    ];

    protected function casts(): array
    {
        return [
            'duration_seconds' => 'integer',
            'track_number' => 'integer',
            'is_explicit' => 'boolean',
        ];
    }

    /**
     * Uma música pertence a um álbum.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Uma música pode pertencer a várias playlists.
     */
    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }
}