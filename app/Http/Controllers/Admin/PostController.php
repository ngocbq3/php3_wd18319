<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
