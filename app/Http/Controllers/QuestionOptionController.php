<?php

namespace App\Http\Controllers;

use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
{
    public function index()
    {
        $questionOptions = QuestionOption::with('question')->get();
        return view('questionOptions.index', compact('questionOptions'));
    }

    public function show(QuestionOption $questionOption)
    {
        return view('questionOptions.show', compact('questionOption'));
    }

    public function create()
    {
        return view('questionOptions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:questions,id',
        ]);

        $questionOption = QuestionOption::create($data);
        return redirect()->route('questionOptions.show', $questionOption);
    }

    public function edit(QuestionOption $questionOption)
    {
        return view('questionOptions.edit', compact('questionOption'));
    }

    public function update(Request $request, QuestionOption $questionOption)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:questions,id',
        ]);

        $questionOption->update($data);
        return redirect()->route('questionOptions.show', $questionOption);
    }

    public function destroy(QuestionOption $questionOption)
    {
        $questionOption->delete();
        return redirect()->route('questionOptions.index');
    }
}
