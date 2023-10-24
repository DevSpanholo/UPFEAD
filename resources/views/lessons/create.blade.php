@extends('layouts.app')

@section('title', 'Criar Nova Aula')

@section('contents')
<h2>Criar Nova Aula</h2>

<form action="{{ route('lessons.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Conteúdo (material de apoio):</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="course_id">Curso:</label>
        <select name="course_id" id="course_id" class="form-control" required>
            <option value="" disabled selected>Selecione um curso</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <select name="module_id" id="module_id" class="form-control">
            <option value="" disabled selected>Selecione um módulo</option>
            @foreach($modules as $module)
                <option value="{{ $module->id }}" data-course-id="{{ $module->course->id }}" style="display: none;">
                    {{ $module->name }} ({{ $module->course->name }})
                </option>
            @endforeach
        </select>
        

        </div> 
    <div class="form-group">
    <button type="submit" class="btn btn-primary">Criar Aula</button>

    <a href="{{ route('modules.create') }}" class="btn btn-secondary">Cadastrar Módulo</a>
    <a href="{{ route('courses.create') }}" class="btn btn-secondary">Cadastrar Curso</a>
    </div>

    
</form>


<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    CKEDITOR.replace('description');

    document.getElementById('course_id').addEventListener('change', function() {
        const selectedCourseId = this.value;
        const moduleOptions = document.querySelectorAll('#module_id option');

        moduleOptions.forEach(option => {
            if (option.getAttribute('data-course-id') === selectedCourseId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        document.getElementById('module_id').value = '';
    });
});
</script>



@endsection
