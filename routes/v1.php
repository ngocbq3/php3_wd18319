<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return 'V1 OK';
});
//Edit route api


Route::get('posts', [PostController::class, 'index']);
