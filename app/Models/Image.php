<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'url', 'preview_url', 'task_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
