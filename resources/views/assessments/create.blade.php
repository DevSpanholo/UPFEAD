@if(auth()->user()->role == 'Administração')
    @extends('layouts.app')

    @section('title', 'Adicionar Prova')

    @section('contents')
        <h1 class="mb-0">Adicionar Prova</h1>
        <hr />
        <form action="{{ route('assessments.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Título</label>
                    <input type="text" name="title" class="form-control" placeholder="Título" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Módulo</label>
                    <select name="module_id" class="form-control">
                        <option value="">Selecione um Módulo</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="questions-container">
                <!-- Questões serão adicionadas aqui -->
            </div>
            <button type="button" id="add-question" class="btn btn-secondary mb-3">Adicionar Questão</button>
            <div class="row">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

        <template id="question-template">
            <div class="question mb-3 p-3 border">
                <label>Texto da Questão:</label>
                <input type="text" name="questions[][text]" class="form-control mb-2" required>
                <div class="options-container">
                    <!-- Opções serão adicionadas aqui -->
                </div>
                <button type="button" class="add-option btn btn-secondary mb-2">Adicionar Opção</button>
                <label>Opção Correta:</label>
                <input type="number" name="questions[][correct_option]" class="form-control" required>
            </div>
        </template>

        <template id="option-template">
            <div class="option mb-2">
                <input type="text" name="questions[][options][]" class="form-control" placeholder="Opção" required>
            </div>
        </template>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const questionsContainer = document.getElementById('questions-container');
                const addQuestionButton = document.getElementById('add-question');
                const questionTemplate = document.getElementById('question-template').content;
                const optionTemplate = document.getElementById('option-template').content;

                addQuestionButton.addEventListener('click', function () {
                    const questionClone = document.importNode(questionTemplate, true);
                    const addOptionButton = questionClone.querySelector('.add-option');
                    const optionsContainer = questionClone.querySelector('.options-container');

                    addOptionButton.addEventListener('click', function () {
                        const optionClone = document.importNode(optionTemplate, true);
                        optionsContainer.appendChild(optionClone);
                    });

                    questionsContainer.appendChild(questionClone);
                });
            });
        </script>
    @endpush
@endif
