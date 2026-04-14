<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // camps que es poden guardar des de formularis
    protected $fillable = [
        'title',
        'platform',
        'release_year',
        'description',
        'genre_id',
        'user_id',
        'status',
        'rating',
        'notes'
    ];

    // cada videojoc pertany a un gènere
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // cada videojoc pertany a un usuari
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}