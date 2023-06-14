<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'tag_tasks', 'tag_id', 'task_id');
    }
}
