@extends('layouts.app')

@section('title', 'Editar curso')

@section('contents')
    <h1 class="mb-0">Editar curso</h1>
    <hr />
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $course->name }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="description" placeholder="Description">{{ $course->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Atualizar</button>
            </div>
        </div>
    </form>
@endsection
