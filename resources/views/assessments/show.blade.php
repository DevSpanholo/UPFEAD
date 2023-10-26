@if(auth()->user()->role == 'Administração')
    @extends('layouts.app')

    @section('title', 'Ver Prova')

    @section('contents')
        <h1 class="mb-0">Detalhes da Prova</h1>
        <hr />
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" value="{{ $assessment->title }}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Questões</label>
                <ul class="list-group">
                    @foreach($assessment->questions as $question)
                        <li class="list-group-item">
                            <strong>{{ $loop->iteration }}.</strong> {{ $question->text }}
                            <ul>
                                @foreach($question->options as $option)
                                    <li>{{ $option->description }} @if($option->is_correct) (Correta) @endif</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Criado em</label>
                <input type="text" class="form-control" value="{{ $assessment->created_at->format('d/m/Y H:i:s') }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Atualizado em</label>
                <input type="text" class="form-control" value="{{ $assessment->updated_at->format('d/m/Y H:i:s') }}" readonly>
            </div>
        </div>
    @endsection
@endif
