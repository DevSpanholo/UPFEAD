<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\assessments;

class Module extends Model
{
    use HasFactory;

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    protected $fillable = [
        'course_id',
        'name',
        'description',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}
