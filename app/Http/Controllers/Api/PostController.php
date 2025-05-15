<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Danh sách bài viết
    public function index()
    {
        $posts = Post::query()->latest('id')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Danh sách bài viết',
            'data' => $posts
        ]);
    }

    //trả về 1 bài viết
    public function show($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            return response()->json($post);
        }
        return response()->json([
            'status' => false,
            'message' => 'Bài viết không tồn tại'
        ], Response::HTTP_NOT_FOUND);
    }

    //Xóa dữ liệu
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa dữ liệu thành công'
            ], Response::HTTP_ACCEPTED);
        }
        return response()->json([
            'message' => "Không có bài viết có id=$id"
        ], Response::HTTP_NOT_FOUND);
    }

    //Lưu dữ liệu được thêm vào database
    public function store(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'min:10'],
                'image' => ['required', 'image'],
                'description' => ['required', 'min:5'],
                'content' => ['required', 'min:25'],
                'view' => ['required', 'integer', 'min:0']
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                'errors' => $validated->errors()
            ]);
        }

        $data = $request->except('image');
        $data['image'] = "";
        //Kiểm tra file
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }
        //Lưu data vào databse
        $post = Post::query()->create($data);

        return response()->json([
            'status' => true,
            'message' => "Thêm dữ liệu thành công",
            'data' => $post
        ], Response::HTTP_CREATED);
    }

    //Cập nhật dữ liệu
    public function update(Request $request, Post $post)
    {
        $data = $request->except('image');
        $old_image = $post->image;
        //Người dùng không upload ảnh mới
        $data['image'] = $old_image;
        //Người dùng upload ảnh
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }

        //update data
        $post->update($data);
        //Xóa ảnh
        if ($request->hasFile('image')) {
            if (file_exists('storage/' . $old_image)) {
                unlink('storage/' . $old_image);
            }
        }

        return response()->json([
            'status' => true,
            'message' => "Cập nhật dữ liệu thành công",
            'data' => $post
        ], Response::HTTP_OK);
    }
}
