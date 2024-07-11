<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/about-us', function () {
    return "TRANG GIỚI THIỆU";
})->name('page.about');

Route::view('/contact', 'contact');
Route::get('/product/{id}', function (int $id) {
    return "PRODUCT ID: $id";
});
Route::get(
    '/product/{id}/comment/{comment_id}',
    function ($id, $comment_id) {
        return "Product ID: $id - Comment id: $comment_id";
    }
)->where('id', '[0-9]+');

//Nhóm tiền tố đường dẫn
Route::prefix('admin')->group(function () {
    Route::get('product', function () {
        return "PRODUCT";
    });

    Route::get('/users', function () {
        return "USERS";
    });
});

//Áp dụng query builder
Route::get('/posts', function () {
    // $posts = DB::table('posts')->get(); //lấy dữ liệu bảng posts
    //Lấy dữ liệu theo số lượng bản ghi
    // $posts = DB::table('posts')
    //     ->limit(10)
    //     ->get();
    //Lấy ra tất cả các bài viết có lượt xem (view) > 800

    //Cập nhật dữ liệu
    // DB::table('posts')
    //     ->where('id', '=', 2)
    //     ->update([
    //         'title' => 'Bài viết đươc cập nhật'
    //     ]);
    //Xóa dữ liệu
    // DB::table('posts')->where('id', '=', 6)->delete();

    // $posts = DB::table('posts')
    //     ->where('view', '>', 800)
    //     ->get();
    //Nối 2 bảng categories và posts
    // $posts = DB::table('posts')
    //     ->join('categories', 'cate_id', '=', 'categories.id')
    //     ->get();

    $posts = DB::table('posts')
        ->orderBy('view', 'desc')
        ->limit(8)
        ->get();
    return $posts;
});

Route::get('/post-list', function () {
    $posts =
        DB::table('posts')
        ->orderBy('view', 'desc')
        ->limit(8)
        ->get();

    return view('post-list', compact('posts'));
});

Route::get('/category/{id}', function ($id) {
    $posts = DB::table('posts')
        ->where('cate_id', $id)
        ->get();
    return view('post-list', compact('posts'));
});

Route::get('/post/{id}', function ($id) {
    $post = DB::table('posts')
        ->where('id', $id)
        ->first();
    return $post;
})->name('post.detail');
