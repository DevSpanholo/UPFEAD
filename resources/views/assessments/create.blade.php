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
                                <div class="col-sm-1 text-center">
                                    <input class="form-check-input me-2" type="checkbox" name="questions[{{ $keyQ }}][options][{{ $keyO }}][is_correct]" {{ $option['is_correct'] ? 'checked' : '' }} onchange="updateCorrectOption(this, {{ $keyQ }}, {{ $keyO }})">
                                </div>
                                
                                <div class="col-sm-1">
                                    <label class="form-check-label me-2" for="option{{ $keyO }}">({{ chr(65 + $keyO) }})</label>
                                </div>

                                <div class="col-sm-10">
                                    <input type="text" name="questions[{{ $keyQ }}][options][{{ $keyO }}]" class="form-control" placeholder="Opção" required value="{{ $option['text'] }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <button type="button" id="add-question" class="btn btn-secondary mb-3">Adicionar Questão</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
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

