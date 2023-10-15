@extends('layouts.app')

@section('title', 'Gestão de Matrículas')

@section('contents')
    <h1 class="mb-0">Adicionar Matrícula</h1>
    <hr />
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Aluno</label>
                <select class="form-control" id="student_id" name="student_id">
                @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->username }}</option>
        @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection
