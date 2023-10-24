<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessments = Assessment::with('user', 'questions')->get();
        return view('assessments.index', compact('assessments'));
    }

    public function show(Assessment $assessment)
    {
        return view('assessments.show', compact('assessment'));
    }

    public function create()
    {
        return view('assessments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'result' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $assessment = Assessment::create($data);
        return redirect()->route('assessments.show', $assessment);
    }

    public function edit(Assessment $assessment)
    {
        return view('assessments.edit', compact('assessment'));
    }

    public function update(Request $request, Assessment $assessment)
    {
        $data = $request->validate([
            'result' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $assessment->update($data);
        return redirect()->route('assessments.show', $assessment);
    }

    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
        return redirect()->route('assessments.index');
    }
}
