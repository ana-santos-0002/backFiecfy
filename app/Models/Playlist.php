<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Uma playlist pertence a um usuário.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Uma playlist possui várias músicas.
     */
    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }
}