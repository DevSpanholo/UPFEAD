<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Slide;
use App\Models\Course;
use App\Models\Module;


class LessonController extends Controller

{
    public function index()
{
    $lessons = Lesson::with('slides')->get();
    return view('lessons.index', compact('lessons'));
}
    public function create()
{
    $modules = Module::with('course')->get();
    $courses = Course::all();
    return view('lessons.create', ['modules' => $modules, 'courses' => $courses]);
}

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'course_id' => 'required|exists:courses,id',
        'module_id' => 'required|exists:modules,id',
    ]);

    Lesson::create($data);

    return redirect()->route('lessons.index')->with('success', 'Aula criada com sucesso!');
}

public function show($id)
{
    $lesson = Lesson::find($id);
    return view('lessons.show', compact('lesson'));
}

 /**
     * Mostra o formulário para editar a aula especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all();
        $modules = Module::all();

        return view('lessons.edit', compact('lesson', 'courses', 'modules'));
    }

    /**
     * Atualiza a aula especificada no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->course_id = $request->input('course_id');
        $lesson->module_id = $request->input('module_id');
        
        $lesson->save();

        return redirect()->route('lessons.index')->with('success', 'Aula atualizada com sucesso!');
    }


}
