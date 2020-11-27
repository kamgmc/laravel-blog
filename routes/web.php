<?php

use App\Models\Post;
use App\Models\Status;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia\Inertia::render('Admin', [
        'posts' => Post::with('status')->orderByDesc('id')->get()
    ]);
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/create', function () {
    return Inertia\Inertia::render('Posts/CreatePostForm', [
        'statusList' => Status::all()
    ]);
})->name('posts.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/edit', function () {
    return Inertia\Inertia::render('Posts/EditPostForm', [
        'statusList' => Status::all(),
        'post' => Post::find(request()->get('id'))->makeVisible('status_id')
    ]);
})->name('posts.edit');
