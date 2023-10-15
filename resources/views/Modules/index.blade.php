@extends('layouts.app')

@section('title', 'Gerenciar Módulos')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Listagem de Módulos</h1>
        <a href="{{ route('modules.create') }}" class="btn btn-primary">Adicionar Módulo</a>
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
                <th>Curso</th> <!-- Adicionado o campo Curso -->
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        @if($modules->count() > 0)
                @foreach($modules as $module)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $module->name }}</td>
                        <td class="align-middle">{{ $module->description }}</td>
                        <td class="align-middle">{{ $module->course->name }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('modules.show', $module->id) }}" type="button" class="btn btn-secondary">Informações</a>
                                <a href="{{ route('modules.edit', $module->id)}}" type="button" class="btn btn-warning">Editar</a>
                                <form action="{{ route('modules.destroy', $module->id) }}" method="POST" onsubmit="return confirm('Excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Nenhum módulo encontrado.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
