@extends('layouts.app')

@section('title', 'Detalhes da Matrícula')

@section('contents')
    <h1 class="mb-0">Detalhes da Matrícula</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Curso</label>
            <input type="text" class="form-control" value="{{ $enrollment->course->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Aluno</label>
            <input type="text" class="form-control" value="{{ $enrollment->student->username }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Data de Matrícula</label>
            <input type="text" class="form-control" value="{{ $enrollment->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Última Atualização</label>
            <input type="text" class="form-control" value="{{ $enrollment->updated_at }}" readonly>
        </div>
    </div>
@endsection
