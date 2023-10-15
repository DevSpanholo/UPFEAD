@extends('layouts.app')

@section('title', 'Adicionar Módulo')

@section('contents')
    <h1 class="mb-0">Adicionar Módulo</h1>
    <hr />
    <form action="{{ route('modules.create') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Nome do Módulo</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Descrição do Módulo</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-control" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
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
