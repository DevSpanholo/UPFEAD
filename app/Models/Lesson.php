<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $table = 'lessons';

    protected $fillable = ['title', 'description', 'course_id', 'module_id', 'user_id'];

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
