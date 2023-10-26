@extends('layouts.app')

@section('title', 'Listagem de Aulas')

@section('contents')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="mb-0">Listagem de Aulas</h1>
        @if(auth()->user()->role == 'Professor')
            <a href="{{ route('lessons.create') }}" class="btn btn-primary">Adicionar Aula</a>
        @endif
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @foreach($lessons->groupBy('module_id') as $moduleId => $lessonsGroup)
        <div class="card mb-4">
            <div class="card-header">
                {{ $lessonsGroup->first()->module->name ?? 'Módulo' }}
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            @if(auth()->user()->role == 'Professor')
                                <th>Ação</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lessonsGroup as $index => $lesson)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $lesson->title }}</td>
                                <td class="align-middle">
                                    <div class="content-display" style="max-height:100px; overflow:auto;">
                                        {!! $lesson->description !!}
                                    </div>
                                </td>
                                @if(auth()->user()->role == 'Professor')
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Ações">
                                            <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Editar</a>
                                            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endsection
