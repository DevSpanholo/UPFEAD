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
            <ul class="list-group list-group-flush">
                @foreach($lessonsGroup as $lesson)
                    <li class="list-group-item">
                        <strong>{{ $lesson->title }}</strong>
                        <div class="mt-2 content-display" style="height:300px; overflow:auto;">
                            {!! $lesson->description !!}
                        </div>
                        @if(auth()->user()->role == 'Professor')
                            <div class="mt-2">
                                <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Deletar</button>
                                </form>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endsection
