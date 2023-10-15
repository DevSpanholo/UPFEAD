<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:Professor,Administração')->only(['create', 'store']);
    }

    public function index()
    {
        $enrollments = Enrollment::with('student')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $courses = Course::all();
        $students = User::where('role', 'Aluno')->get();
        return view('enrollments.create', compact('courses', 'students'));
    }

    public function store(Request $request)
    {
        Enrollment::create($request->all());
        return redirect()->route('enrollments.index')->with('success', 'Matrícula criada com sucesso!');
    }

    public function show(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $courses = Course::all();
        $students = User::where('role', 'Aluno')->get();
        return view('enrollments.edit', compact('enrollment', 'courses', 'students'));
    }

    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());
        return redirect()->route('enrollments.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Matrícula excluída com sucesso!');
    }

    public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

}
