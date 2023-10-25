<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $table = 'questions_options';

    protected $fillable = [
        'description',
        'is_correct',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function assessments()
    {
        return $this->belongsToMany(Assessment::class, 'assessment_questions_user')
                    ->withPivot('questions_id')
                    ->withTimestamps();
    }
}
