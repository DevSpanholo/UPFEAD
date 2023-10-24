@if(auth()->user()->role == 'Administração')
    @extends('layouts.app')

    @section('title', 'Adicionar Prova')

    @section('contents')
        <h1 class="mb-4">Adicionar Prova</h1>
        <form action="{{ route('assessments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Título" required>
            </div>
            <div class="mb-3">
                <label for="module_id" class="form-label">Módulo</label>
                <select id="module_id" name="module_id" class="form-control">
                    <option value="">Selecione um Módulo</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="questions-container" class="mb-3">
                <!-- Questões serão adicionadas aqui -->
            </div>
            <button type="button" id="add-question" class="btn btn-secondary mb-3">Adicionar Questão</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        <template id="question-template">
            <div class="question mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="mb-0">Texto da Questão:</label>
                    <button type="button" class="remove-question btn btn-danger btn-sm">Remover Questão</button>
                </div>
                <input type="text" name="questions[][text]" class="form-control mb-3" required>
                <div class="options-container mb-3">
                    <!-- Opções serão adicionadas aqui -->
                </div>
                <button type="button" class="add-option btn btn-secondary btn-sm mb-3">Adicionar Opção</button>
            </div>
        </template>

        <template id="option-template">
            <div class="option d-flex mb-2">
                <input type="text" name="questions[][options][]" class="form-control col-8 me-2" placeholder="Opção" required>
                <div class="form-check col-2">
                    <input class="form-check-input" type="checkbox" name="questions[][correct_option]">
                </div>
                <button type="button" class="remove-option btn btn-danger btn-sm col-2">
                    <i class="bi bi-trash">Deletar opção</i>
                </button>
            </div>
        </template>
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const questionsContainer = document.getElementById('questions-container');
            const addQuestionButton = document.getElementById('add-question');
            const questionTemplate = document.getElementById('question-template').content;
            const optionTemplate = document.getElementById('option-template').content;
    
            addQuestionButton.addEventListener('click', function () {
                const questionClone = document.importNode(questionTemplate, true);
                const questionElement = questionClone.querySelector('.question');
                const addOptionButton = questionElement.querySelector('.add-option');
                const optionsContainer = questionElement.querySelector('.options-container');
                const removeQuestionButton = questionElement.querySelector('.remove-question');
    
                addOptionButton.addEventListener('click', function () {
                    const optionClone = document.importNode(optionTemplate, true);
                    const optionElement = optionClone.querySelector('.option');
                    const removeOptionButton = optionElement.querySelector('.remove-option');
    
                    removeOptionButton.addEventListener('click', function () {
                        optionElement.remove();
                    });
    
                    optionsContainer.appendChild(optionElement);
                });
    
                removeQuestionButton.addEventListener('click', function () {
                    questionElement.remove();
                });
    
                questionsContainer.appendChild(questionElement);
            });
        });
    </script>
    
@endif
