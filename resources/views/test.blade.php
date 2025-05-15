<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@foreach ($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
    </div>
@endforeach
{{ $posts->links() }}
