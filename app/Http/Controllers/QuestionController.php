<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('module', 'options')->get();
        return view('questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'module_id' => 'required|exists:modules,id',
        ]);

        $question = Question::create($data);
        return redirect()->route('questions.show', $question);
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'module_id' => 'required|exists:modules,id',
        ]);

        $question->update($data);
        return redirect()->route('questions.show', $question);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index');
    }
}
