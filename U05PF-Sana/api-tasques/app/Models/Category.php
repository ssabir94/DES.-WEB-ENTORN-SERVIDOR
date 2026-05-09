<?php

namespace App\Models;
use App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Camps que es poden omplir
    protected $fillable = [
        'nom'
    ];

    // Una categoria té moltes tasques
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}