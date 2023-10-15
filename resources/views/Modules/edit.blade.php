@extends('layouts.app')

@section('title', 'Editar Módulo')

@section('contents')
    <h1 class="mb-0">Editar Módulo</h1>
    <hr />
    <form action="{{ route('modules.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Nome do Módulo</label>
                <input type="text" name="name" class="form-control" value="{{ $module->name }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Descrição do Módulo</label>
                <textarea name="description" class="form-control">{{ $module->description }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $module->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Atualizar</button>
            </div>
        </div>
    </form>
@endsection
