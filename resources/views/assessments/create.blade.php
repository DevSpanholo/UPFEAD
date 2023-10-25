@extends('layouts.app')

@section('title', 'Adicionar Prova')

@section('contents')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
            @php
                $questions = [
                    [
                        'text' => '',
                        'options' => [
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false]
                        ],
                        'correct_option' => ''
                    ],
                    [
                        'text' => '',
                        'options' => [
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false],
                            ['text' => '', 'is_correct' => false]
                        ],
                        'correct_option' => ''
                    ]
                ];
            @endphp

            @foreach ($questions as $keyQ => $question)
                <div class="question mb-2 p-2 border rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="mb-0">Texto da Questão {{ $keyQ + 1 }}:</label>
                        <button type="button" class="remove-question btn btn-danger btn-sm">Remover Questão</button>
                    </div>
                    <input type="text" name="questions[{{ $keyQ }}][text]" class="form-control mb-3" required value="{{ $question['text'] }}">
                    <input type="hidden" name="questions[{{ $keyQ }}][correct_option]" class="correct-option" value="{{ $question['correct_option'] }}">
                    <div class="options-container mb-3">
                        @foreach($question['options'] as $keyO => $option)
                            <div class="option d-flex align-items-center mb-2">
                                <input class="form-check-input me-2" type="checkbox" name="questions[{{ $keyQ }}][options][{{ $keyO }}][is_correct]" {{ $option['is_correct'] ? 'checked' : '' }} onchange="updateCorrectOption(this, {{ $keyQ }}, {{ $keyO }})">
                                <label class="form-check-label me-2" for="option{{ $keyO }}">({{ chr(65 + $keyO) }})</label>
                                <input type="text" name="questions[{{ $keyQ }}][options][{{ $keyO }}][text]" class="form-control" placeholder="Opção" required value="{{ $option['text'] }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
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
            <input type="text" name="questions[1][text]" class="form-control mb-3" required>
            <input type="hidden" name="questions[1][correct_option]" class="correct-option" value="">
            <div class="options-container mb-3">
                @for ($i = 0; $i < 5; $i++)
                    <div class="option d-flex mb-2">
                        <div class="col-1 text-center pt-2">
                            ({{ chr(65 + $i) }})
                        </div>
                        <input type="text" name="questions[1][options][{{ $i }}][text]" class="form-control col-7 me-2" placeholder="Opção" required>
                        <div class="form-check col-2">
                            <input class="form-check-input" type="checkbox" name="questions[1][options][{{ $i }}][is_correct]" onchange="updateCorrectOption(this, 1, {{ $i }})">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </template>
@endsection

    <script>
        window.updateCorrectOption = function(checkbox, questionIndex, optionIndex) {
            console.log('updateCorrectOption chamado', checkbox, questionIndex, optionIndex);
            const questionElement = checkbox.closest('.question');
            const correctOptionInput = questionElement.querySelector('.correct-option');
            
            if (checkbox.checked) {
                correctOptionInput.value = optionIndex + 1;
            } else if (correctOptionInput.value == optionIndex + 1) {
                correctOptionInput.value = '';
            }

            console.log('Valor atualizado para:', correctOptionInput.value);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const questionsContainer = document.getElementById('questions-container');
            const addQuestionButton = document.getElementById('add-question');
            const questionTemplate = document.getElementById('question-template').content;

            function updateQuestionNumbers() {
                const questions = questionsContainer.getElementsByClassName('question');
                for (let i = 0; i < questions.length; i++) {
                    questions[i].querySelector('label').textContent = `Texto da Questão ${i + 1}:`;
                }
            }

            addQuestionButton.addEventListener('click', function () {
                const questionClone = document.importNode(questionTemplate, true);
                const questionElement = questionClone.querySelector('.question');
                const questionLabel = questionElement.querySelector('label');
                const removeQuestionButton = questionElement.querySelector('.remove-question');

                const questionCount = questionsContainer.children.length;

                questionLabel.textContent = `Texto da Questão ${questionCount + 1}:`;
                questionElement.querySelector('input[type="text"]').setAttribute('name', `questions[${questionCount}][text]`);
                questionElement.querySelector('.correct-option').setAttribute('name', `questions[${questionCount}][correct_option]`);
                const optionsContainer = questionElement.querySelector('.options-container');
                const options = optionsContainer.children;

                for (let i = 0; i < options.length; i++) {
                    options[i].querySelector('input[type="text"]').setAttribute('name', `questions[${questionCount}][options][${i}][text]`);
                    options[i].querySelector('input[type="checkbox"]').setAttribute('name', `questions[${questionCount}][options][${i}][is_correct]`);
                    options[i].querySelector('input[type="checkbox"]').setAttribute('onchange', `updateCorrectOption(this, ${questionCount}, ${i})`);
                }

                removeQuestionButton.addEventListener('click', function () {
                    questionElement.remove();
                    updateQuestionNumbers();
                });

                questionsContainer.appendChild(questionElement);
            });
        });
    </script>

