@extends('layouts.app')

@section('title', 'Listagem de Aulas')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Listagem de Aulas</h1>
        <a href="{{ route('lessons.create') }}" class="btn btn-primary">Adicionar Aula</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Curso</th>
                <th>Módulo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @if($lessons->count() > 0)
            @foreach($lessons as $lesson)
                <tr>
                    <td class="align-middle">{{ $lesson->id }}</td>
                    <td class="align-middle">{{ $lesson->title }}</td>
                    <td class="align-middle">{{ $lesson->description ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $lesson->course->name ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $lesson->module->name ?? 'N/A' }}</td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('lessons.show', $lesson->id) }}" type="button" class="btn btn-secondary">Detalhes</a>
                            <a href="{{ route('lessons.edit', $lesson->id) }}" type="button" class="btn btn-warning">Editar</a>
                            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="6">Nenhuma aula encontrada.</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
