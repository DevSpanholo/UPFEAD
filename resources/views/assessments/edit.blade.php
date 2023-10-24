@if(auth()->user()->role == 'Administração')
    @extends('layouts.app')

    @section('title', 'Editar Prova')

    @section('contents')
        <h1 class="mb-0">Editar Prova</h1>
        <hr />
        <form action="{{ route('assessments.update', $assessment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Título</label>
                    <input type="text" name="title" class="form-control" placeholder="Título" value="{{ $assessment->title }}" required>
                </div>
            </div>
            <div id="questions-container">
                @foreach($assessment->questions as $question)
                    <div class="question-block">
                        <label class="form-label">Questão</label>
                        <input type="text" name="questions[{{ $loop->index }}][text]" class="form-control" placeholder="Texto da Questão" value="{{ $question->text }}" required>
                        <div class="options-container">
                            @foreach($question->options as $option)
                                <div class="option-block">
                                    <label class="form-label">Opção</label>
                                    <input type="text" name="questions[{{ $loop->parent->index }}][options][{{ $loop->index }}]" class="form-control" placeholder="Texto da Opção" value="{{ $option->text }}" required>
                                </div>
                            @endforeach
                        </div>
                        <label class="form-label">Opção Correta</label>
                        <input type="number" name="questions[{{ $loop->index }}][correct_option]" class="form-control" placeholder="Número da Opção Correta" value="{{ $question->correct_option }}" required min="1" max="4">
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-warning">Atualizar</button>
                </div>
            </div>
        </form>
    @endsection
@endif
