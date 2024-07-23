<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-4">
        <h1>Thêm mới bài viết</h1>
        <a href="{{ route('post.index') }}" class="btn btn-primary">List</a>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input class="form-control" type="file" name="image">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="6"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">View</label>
                <input type="number" name="view" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="category_id" class="form-select" id="">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}">
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

</body>

</html>
