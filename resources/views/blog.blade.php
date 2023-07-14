@extends('app')

@section('content')
    <div class="containet px-3 py-5">
        <h1>Blog</h1>
        <hr>
        @foreach ($posts as $post)
            <h4>{{ $post->title }}</h4>
            <p class="small text-secondary">
                <i>Fecha de publicación</i> {{ $post->created_at->format('d-m-T') }} <br>
                <a href="{{ route('post', $post->slug) }}">ver más &raquo;</a>
            </p>
        @endforeach
    </div>
@endsection
