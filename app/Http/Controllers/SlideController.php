<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\Lesson;



class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('slides.index', ['slides' => $slides]);
    }
    public function create()
    {
        $lessons = Lesson::all();
        return view('slides.create', compact('lessons'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'lesson_id' => 'required|exists:lessons,id',
        ]);
    
        Slide::create($data);
    
        return redirect()->route('slides.index')->with('success', 'Slide criado com sucesso!');
    }
    
}
