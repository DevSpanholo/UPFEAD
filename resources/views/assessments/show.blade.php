@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliação: {{ $assessment->id }}</h1>
    <p>Resultado: {{ $assessment->result }}%</p>
    <p>Usuário: {{ $assessment->user->name }}</p>
    <h3>Perguntas</h3>
    @foreach($assessment->questions as $question)
        <div>
            <p>{{ $question->text }}</p>
            <p>Resposta: {{ $question->pivot->questions_options_id }}</p>
        </div>
    @endforeach
    <a href="{{ route('assessments.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
