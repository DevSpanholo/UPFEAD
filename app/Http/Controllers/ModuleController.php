<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Course;
use App\Models\User;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course')->get();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        $courses = Course::all();
        $students = User::where('role', 'Aluno')->get();
        return view('modules.create', compact('courses', 'students'));
    }
    


    public function store(Request $request)
    { 
         $data = [
        'course_id' => $request->input('course_id'), 
        'name' => $request->input('name'),
        'description' => $request->input('description'), 
    ];
    Module::create($data);

    return redirect()->route('modules.index')->with('success', 'Módulo criado com sucesso!');
    }

    public function show(string $id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }

    public function edit(string $id)
    {
        $module = Module::findOrFail($id);
        $courses = Course::all();
        return view('modules.edit', compact('module', 'courses'));
    }

    public function update(Request $request, string $id)
    {
        $module = Module::findOrFail($id);
        $module->update($request->all());
        return redirect()->route('modules.index')->with('success', 'Módulo atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $module = Module::findOrFail($id);
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Módulo excluído com sucesso!');
    }
}
