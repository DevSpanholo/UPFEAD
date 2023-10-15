@extends('layouts.app')

@section('title', 'Listagem de Matrículas')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Listagem de Matrículas</h1>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Adicionar Matrícula</a>
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
                <th>Curso</th>
                <th>Aluno</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @if($enrollments->count() > 0)
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td class="align-middle">{{ $enrollment->id }}</td>
                        <td class="align-middle">{{ $enrollment->course->name ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $enrollment->student->username ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $enrollment->created_at }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('enrollments.show', $enrollment->id) }}" type="button" class="btn btn-secondary">Detalhes</a>
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" type="button" class="btn btn-warning">Editar</a>
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?')">
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
                    <td class="text-center" colspan="5">Nenhuma matrícula encontrada.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection