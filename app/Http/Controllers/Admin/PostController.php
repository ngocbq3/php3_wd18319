<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function test()
    {
        //Lấy toàn bộ dữ liệu
        // $posts = Post::all();
        //lấy 1 bản ghi
        // $posts = Post::all()->first();

        //Lấy dữ liệu theo điều kiện
        // $posts = Post::where('cate_id', 1)->get();

        //Tìm kiếm dữ liệu gần đúng
        // $posts = Post::query()
        //     ->where('title', 'LIKE', '%aut%')
        //     ->get();

        //Các hàm trong SQL sum, count, avg ...
        // $count = Post::query()
        //     ->where('cate_id', 1)
        //     ->count();
        // $sum = Post::query()->sum('view');
        // return $sum;

        //Thêm dữ liệu
        //1. Sử dụng mảng
        // $data = [
        //     'title' => fake()->text(25),
        //     'image' => fake()->imageUrl(),
        //     'description' => fake()->text(30),
        //     'content' => fake()->paragraph(),
        //     'view' => rand(10, 1000),
        //     'cate_id' => rand(1, 4),
        // ];
        // Post::query()->create($data);
        //2. dùng đối tượng
        // $post = new Post();
        // $post->title = fake()->text(25);
        // $post->image = fake()->imageUrl();
        // $post->description = fake()->text(30);
        // $post->content = fake()->paragraph();
        // $post->view = rand(10, 1000);
        // $post->cate_id = rand(1, 4);
        // $post->save();

        //Cập nhật dữ liệu
        // Post::query()->find(102)->update([
        //     'title' => 'Update Title'
        // ]);

        // Post::query()->find(101)->delete();
        // return $posts;
    }
    public function index()
    {
        $posts = Post::query()->paginate(10);
        return view('listPost', compact('posts'));
    }
    //Hiển thị form create
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    //Lưu dữ liệu được thêm vào database
    public function store(StorePostRequest $request)
    {
        $data = $request->except('image');
        $data['image'] = "";
        //Kiểm tra file
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }
        //Lưu data vào databse
        Post::query()->create($data);
        return redirect()->route('post.index')->with('message', 'Thêm dữ liệu thành công');
    }

    //Xóa bài viết
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', 'Xóa dữ liệu thành công');
    }

    //Hiển thị form edit
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories', 'post'));
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

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }
}
