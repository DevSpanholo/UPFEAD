@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliações</h1>
    <a href="{{ route('assessments.create') }}" class="btn btn-primary">Criar Avaliação</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Resultado</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assessments as $assessment)
                <tr>
                    <td>{{ $assessment->id }}</td>
                    <td>{{ $assessment->result }}%</td>
                    <td>{{ $assessment->user->name }}</td>
                    <td>
                        <a href="{{ route('assessments.show', $assessment) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('assessments.edit', $assessment) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('assessments.destroy', $assessment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
