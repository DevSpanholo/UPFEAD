<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class AssessmentQuestionUserController extends Controller
{
    public function store(Request $request, Assessment $assessment)
    {
        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'question_option_id' => 'required|exists:question_options,id',
        ]);

        $assessment->questions()->attach($data['question_id'], ['questions_options_id' => $data['question_option_id']]);
        return redirect()->route('assessments.show', $assessment);
    }

    public function update(Request $request, Assessment $assessment, Question $question)
    {
        $data = $request->validate([
            'question_option_id' => 'required|exists:question_options,id',
        ]);

        $assessment->questions()->updateExistingPivot($question, ['questions_options_id' => $data['question_option_id']]);
        return redirect()->route('assessments.show', $assessment);
    }

    public function destroy(Assessment $assessment, Question $question)
    {
        $assessment->questions()->detach($question);
        return redirect()->route('assessments.show', $assessment);
    }
}
