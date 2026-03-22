<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Tasca extends Model
{
    protected $table = 'tasques';

    protected $fillable = [
        'title',
        'description',
        'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}