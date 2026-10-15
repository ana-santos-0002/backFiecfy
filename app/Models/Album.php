<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $fillable = [
        'artist_id',
        'title',
        'release_year',
        'cover_image',
    ];

    /**
     * Um álbum pertence a um artista.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Um álbum possui várias músicas.
     */
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}