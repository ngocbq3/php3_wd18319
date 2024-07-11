@extends('layout')

@section('title', 'Trang danh sách bài viết')

@section('content')
    <h1>Phần nội dung website</h1>
    <hr>
    @foreach ($posts as $post)
        <div>
            <a href="{{ route('post.detail', $post->id) }}">
                <h3>{{ $post->title }}</h3>
            </a>
            <div>
                <img src="{{ $post->image }}" width="100" alt="">
            </div>
            <p>{{ $post->description }}</p>
            <p>View: {{ $post->view }}</p>
            <hr>
        </div>
    @endforeach
@endsection
