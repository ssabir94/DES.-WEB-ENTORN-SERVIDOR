<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Task extends Model
{
    // Camps que Laravel permet omplir des del controlador.
    protected $fillable = [
        'user_id',
        'nom',
        'comentari',
        'category_id'
    ];

    // Cada tasca pertany a un usuari.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Cada tasca pertany a una categoria.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}