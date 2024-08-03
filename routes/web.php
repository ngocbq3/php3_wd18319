<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SendMailController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
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

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/about-us', function () {
//     return "TRANG GIỚI THIỆU";
// })->name('page.about');

// Route::view('/contact', 'contact');
// Route::get('/product/{id}', function (int $id) {
//     return "PRODUCT ID: $id";
// });
// Route::get(
//     '/product/{id}/comment/{comment_id}',
//     function ($id, $comment_id) {
//         return "Product ID: $id - Comment id: $comment_id";
//     }
// )->where('id', '[0-9]+');

//Nhóm tiền tố đường dẫn
// Route::prefix('admin')->group(function () {
//     Route::get('product', function () {
//         return "PRODUCT";
//     });

//     Route::get('/users', function () {
//         return "USERS";
//     });
// });

//Áp dụng query builder
// Route::get('/posts', function () {
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

//     $posts = DB::table('posts')
//         ->orderBy('view', 'desc')
//         ->limit(8)
//         ->get();
//     return $posts;
// });

// Route::get('/post-list', function () {
//     $posts =
//         DB::table('posts')
//         ->orderBy('view', 'desc')
//         ->limit(8)
//         ->get();

//     return view('post-list', compact('posts'));
// });

// Route::get('/category/{id}', function ($id) {
//     $posts = DB::table('posts')
//         ->where('cate_id', $id)
//         ->get();
//     return view('post-list', compact('posts'));
// });

// Route::get('/post/{id}', function ($id) {
//     $post = DB::table('posts')
//         ->where('id', $id)
//         ->first();
//     return $post;
// })->name('post.detail');

// Route::prefix('category')->group(function () {
//     Route::get('/list', [CategoryController::class, 'index'])->name('category.index');
// });

Route::get('/test', [PostController::class, 'test']);
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/edit/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

//Login, register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'postRegister'])->name('postRegister');

//Sendmail
Route::get('sendmail', [SendMailController::class, 'send']);
