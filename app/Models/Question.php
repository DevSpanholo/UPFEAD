<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'text',
        'module_id',
        'assessment_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
