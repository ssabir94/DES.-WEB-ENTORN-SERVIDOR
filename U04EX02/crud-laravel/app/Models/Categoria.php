<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tasca;

class Categoria extends Model
{
    protected $fillable = [
        'nom' // 👈 IMPORTANT (no name)
        //Sense $fillable: 👉 no guardarà la categoria
    ];
    public function tasques()
    {
        return $this->hasMany(Tasca::class); //Aquí tinc la relació 1 a molts: una categoria té moltes tasques
    }

}