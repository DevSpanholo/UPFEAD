@if(auth()->user()->role == 'Administração')
    @extends('layouts.app')

    @section('title', 'Gerenciar Provas')

    @section('contents')
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Listagem de Provas</h1>
            <a href="{{ route('assessments.create') }}" class="btn btn-primary">Adicionar Prova</a>
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
                    <th>Quantidade de Questões</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            @if($assessments->count() > 0)
                @foreach($assessments as $assessment)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $assessment->title }}</td>
                        <td class="align-middle">{{ $assessment->questions->count() }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('assessments.show', $assessment->id) }}" type="button" class="btn btn-secondary">Informações</a>
                                <a href="{{ route('assessments.edit', $assessment->id)}}" type="button" class="btn btn-warning">Editar</a>
                                <form action="{{ route('assessments.destroy', $assessment->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
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
                    <td class="text-center" colspan="4">Nenhuma prova encontrada!</td>
                </tr>
            @endif
            </tbody>
        </table>
    @endsection
@endif
