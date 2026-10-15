<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'genre',
        'profile_pic_url',
        'monthly_listeners',
    ];

    /**
     * Um artista possui vários álbuns.
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}