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
        $sum = Post::query()->sum('view');
        return $sum;
        // return $posts;
    }
}
