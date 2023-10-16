@extends('layouts.app')

@section('title', 'Detalhes da Aula')

@section('contents')
    <h1 class="mb-0">Detalhes da Aula</h1>
    <hr />    
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" value="{{ $lesson->title }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" rows="3" readonly>{{ $lesson->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Curso</label>
            <input type="text" class="form-control" value="{{ $lesson->course->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Módulo</label>
            <input type="text" class="form-control" value="{{ $lesson->module->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Data de Criação</label>
            <input type="text" class="form-control" value="{{ $lesson->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Última Atualização</label>
            <input type="text" class="form-control" value="{{ $lesson->updated_at }}" readonly>
        </div>
    </div>
@endsection
