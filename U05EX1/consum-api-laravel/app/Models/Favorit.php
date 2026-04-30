<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    // Indico quins camps es poden omplir automàticament
    protected $fillable = ['post_id', 'title'];
}
