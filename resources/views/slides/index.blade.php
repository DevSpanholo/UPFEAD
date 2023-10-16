@extends('layouts.app')

@section('title', 'Visualizar Slides')

@section('contents')

<div class="reveal">
    <div class="slides">
        @foreach($lessons as $lesson) 
            <!-- Cada aula pode ser uma seção vertical que contém os slides relacionados -->
            <section>
                <section>
                    <h2>{{ $lesson->title }}</h2>
                    <p>{{ $lesson->description }}</p>
                </section>                
                @foreach($lesson->slides as $slide)
                    <section>
                        {!! $slide->content !!}
                    </section>
                @endforeach

            </section>
        @endforeach

    </div>
</div>

@endsection

@push('scripts')
<script>
    Reveal.initialize({
        controls: true,
      controlsTutorial: true,
      controlsLayout: 'bottom-right',
      controlsBackArrows: 'faded',
      progress: true,
      slideNumber: false,
      showSlideNumber: 'all',
      hashOneBasedIndex: false,
      hash: false,
      respondToHashChanges: true,
      jumpToSlide: true,
      history: false,
      keyboard: true,
      keyboardCondition: null,
      backgroundTransition: 'fade',
      pdfSeparateFragments: true,
      display: 'block',
    });
</script>
@endpush
