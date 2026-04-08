<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController; 
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\EditorUploadController;

// ==========================================
// 1. CÁC ROUTE FRONTEND (GIAO DIỆN NGƯỜI ĐỌC)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bai-viet/{slug}.html', [HomeController::class, 'show'])->name('post.detail');
Route::get('/chuyen-muc/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');

// Xử lý gửi bình luận (bắt buộc đăng nhập)
Route::post('/binh-luan/{post_id}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');


// ==========================================
// 2. CÁC ROUTE QUẢN TRỊ VIÊN (ADMIN PANEL)
// ==========================================
Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function () {
    
    // Trang Dashboard thống kê
    Route::get('/', function () {
        $totalPosts = \App\Models\Post::count();           
        $totalCategories = \App\Models\Category::count();  
        $totalUsers = \App\Models\User::count();           
        $totalComments = \App\Models\Comment::count();     
        $draftPosts = 0; 
        $totalViews = \App\Models\Post::sum('views'); 

        return view('admin.dashboard', compact('totalPosts', 'totalCategories', 'totalUsers', 'totalComments', 'draftPosts', 'totalViews'));
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::post('/editor/upload', [EditorUploadController::class, 'upload'])->name('admin.editor.upload');
    
    Route::get('/comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{id}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
});


// ==========================================
// 3. CÁC ROUTE QUẢN LÝ TÀI KHOẢN (LARAVEL BREEZE)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';