@extends('layouts.app')

@section('title', 'Editar Aula')

@section('contents')
    <h1 class="mb-0">Editar Aula</h1>
    <hr />
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="title" value="{{ $lesson->title }}">
            </div>
        </div>
        
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Conteúdo</label>
                <textarea name="description" id="description" class="form-control" rows="3" style="height:300px;">{{ $lesson->description }}</textarea>
            </div>
        </div>
        
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @if($course->id == $lesson->course_id) selected @endif>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col mb-3">
                <label class="form-label">Módulo</label>
                <select name="module_id" class="form-control">
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" @if($module->id == $lesson->module_id) selected @endif>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Atualizar</button>
            </div>
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
