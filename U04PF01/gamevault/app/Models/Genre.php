<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // camps que es poden omplir amb assignació massiva
    protected $fillable = [
        'name',
        'user_id'
    ];

    // un gènere pot tenir molts videojocs
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}