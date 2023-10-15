@extends('layouts.app')

@section('title', 'Detalhes do Módulo')

@section('contents')
    <h1 class="mb-0">Detalhes do Módulo</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nome do Módulo</label>
            <input type="text" class="form-control" value="{{ $module->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Descrição do Módulo</label>
            <textarea class="form-control" readonly>{{ $module->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Curso</label>
            <input type="text" class="form-control" value="{{ $module->course->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Data de Criação</label>
            <input type="text" class="form-control" value="{{ $module->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Última Atualização</label>
            <input type="text" class="form-control" value="{{ $module->updated_at }}" readonly>
        </div>
    </div>
@endsection
