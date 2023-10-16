@extends('layouts.app')

@section('title', 'Gestão de Slides')

@section('contents')
    <h1 class="mb-0">Adicionar Slide</h1>
    <hr />
    <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Título do Slide</label>
                <input type="text" class="form-control" name="slide_title" placeholder="Insira o título do slide">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Conteúdo do Slide</label>
                <textarea class="form-control" name="slide_content" placeholder="Insira o conteúdo do slide" rows="5"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Imagem do Slide</label>
                <input type="file" class="form-control" name="slide_image">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection
