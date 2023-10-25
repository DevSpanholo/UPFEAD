<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Module;

class AssessmentController extends Controller
{

    
    public function index()
    {
        $assessments = Assessment::with('questions')->get();
        return view('assessments.index', compact('assessments'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('assessments.create', compact('modules'));
    }
    

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:5|max:10',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*' => 'required|string|max:255',
            'questions.*.correct_option' => 'required|integer|min:1|max:4',
        ]);

        $assessment = Assessment::create(['title' => $request->title]);

        foreach ($request->questions as $questionData) {
            $question = $assessment->questions()->create(['text' => $questionData['text']]);
            $question->options()->createMany(array_map(function ($option) {
                return ['text' => $option];
            }, $questionData['options']));
            $question->update(['correct_option' => $questionData['correct_option']]);
        }

        return redirect()->route('assessments.index');
    }
    public function edit(Assessment $assessment)
    {
        $assessment->load('questions.options');
        return view('assessments.edit', compact('assessment'));
    }
        public function show(Assessment $assessment)
    {
        $assessment->load('questions.options');
        return view('assessments.show', compact('assessment'));
    }
   


}
