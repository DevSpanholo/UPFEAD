@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Avaliação: {{ $assessment->id }}</h1>
    <form action="{{ route('assessments.update', $assessment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Usuário</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if($assessment->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
