@extends('layouts.app')

@section('title', 'Editar Matrícula')

@section('contents')
    <h1 class="mb-0">Editar Matrícula</h1>
    <hr />
    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @if($course->id == $enrollment->course_id) selected @endif>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Aluno</label>
                <select name="student_id" class="form-control">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" @if($student->id == $enrollment->student_id) selected @endif>
                            {{ $student->username }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Atualizar</button>
            </div>
        </div>
    </form>
@endsection
