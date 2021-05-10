<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'done',
        'todo_id'
    ];


    // castujemy te ktore nie sa INT lub STRING
    protected $casts = [
        'done' => 'boolean'
    ];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }


}
