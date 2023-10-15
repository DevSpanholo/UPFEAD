@extends('layouts.app')

@section('title', 'Ver cursos')

@section('contents')
    <h1 class="mb-0">Detalhes do curso</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $course->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" name="description" readonly>{{ $course->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" value="{{ $course->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" value="{{ $course->updated_at }}" readonly>
        </div>
    </div>
@endsection
