<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'module_id' => 'required|exists:modules,id',
                'questions' => 'required|array|min:2|max:10',
                'questions.*.text' => 'required|string|max:255',
                'questions.*.options' => 'required|array|min:2',
                'questions.*.correct_option' => 'required|integer|min:1|max:4',
            ]);
    
            $assessment = Assessment::create(['title' => $data['title'], 'module_id' => $data['module_id']]);
            
            foreach ($data['questions'] as $questionIndex => $questionData) {
                $question = $assessment->questions()->create([
                    'text' => $questionData['text'],
                    'module_id' => $request->module_id
                ]);
    
                foreach ($questionData['options'] as $optionIndex => $optionData) {
                    $isCorrect = ($optionIndex + 1) == $questionData['correct_option'];
                    $question->options()->create([
                        'description' => $optionData,
                        'is_correct' => $isCorrect ? '1' : '0',
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();dd($e);
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
