@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Avaliação</h1>
    <form action="{{ route('assessments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Usuário</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
