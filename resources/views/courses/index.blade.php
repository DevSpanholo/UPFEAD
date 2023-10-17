@if(auth()->user()->role == 'Administração')
@extends('layouts.app')

@section('title', 'Gerenciar cursos')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Listagem de cursos</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Adicionar curso</a>
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
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        @if($courses->count() > 0)
                @foreach($courses as $course)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $course->name }}</td>
                        <td class="align-middle">{{ $course->description }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('courses.show', $course->id) }}" type="button" class="btn btn-secondary">Informações</a>
                                <a href="{{ route('courses.edit', $course->id)}}" type="button" class="btn btn-warning">Editar</a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="4">Erro, curso não funcionou!</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
@endif