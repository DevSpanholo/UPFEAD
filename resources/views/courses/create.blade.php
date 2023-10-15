@extends('layouts.app')

@section('title', 'Gestão de curso')

@section('contents')
    <h1 class="mb-0">Adicionar Curso</h1>
    <hr />
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="description" placeholder="Descrição"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection
