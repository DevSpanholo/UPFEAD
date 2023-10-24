<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'module_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function assessments()
    {
        return $this->belongsToMany(Assessment::class, 'assessment_questions_user')
                    ->withPivot('questions_options_id')
                    ->withTimestamps();
    }
}
