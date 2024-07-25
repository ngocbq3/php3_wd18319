<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-4">
        <h1>Cập nhật bài viết</h1>
        <a href="{{ route('post.index') }}" class="btn btn-primary">List</a>

        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input class="form-control" type="file" name="image" id="fileImage">
                <br>
                <img id="img" src="{{ asset('/storage/' . $post->image) }}" width="60"
                    alt="{{ $post->title }}">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="6">{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">View</label>
                <input type="number" name="view" class="form-control" value="{{ $post->view }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="cate_id" class="form-select" id="">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @if ($cate->id == $post->cate_id) selected @endif>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <script>
        var fileImage = document.querySelector('#fileImage')
        var img = document.querySelector('#img')

        //thay đổi ảnh
        fileImage.addEventListener('change', function(e) {
            e.preventDefault();
            img.src = URL.createObjectURL(this.files[0]);
        })
    </script>
</body>

</html>
