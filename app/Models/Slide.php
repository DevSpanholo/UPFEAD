<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{

    protected $table = 'slides';

    protected $fillable = ['title', 'description', 'lesson_id'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
