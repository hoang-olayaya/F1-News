<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 1 bài xuất bản mới nhất làm banner to đùng (Hero Post)
        $heroPost = Post::where('status', 'published')
                        ->orderBy('id', 'desc')
                        ->first();

        // Lấy 4 bài tiếp theo làm danh sách tin mới (Trừ bài Hero ở trên ra)
        $latestPosts = collect();
        if ($heroPost) {
            $latestPosts = Post::where('status', 'published')
                            ->where('id', '!=', $heroPost->id)
                            ->orderBy('id', 'desc')
                            ->take(4)
                            ->get();
        }

        return view('frontend.home', compact('heroPost', 'latestPosts'));
    }

    public function show($slug)
    {
        // 1. Lấy bài viết hiện tại
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // 2. Tăng view
        $post->increment('views');

        // 3. Lấy tin liên quan
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->where('status', 'published')
                            ->orderBy('id', 'desc')
                            ->take(4)
                            ->get();

        // [MỚI THÊM] 4. Lấy 5 bài viết nhiều lượt xem nhất
        $trendingPosts = Post::where('status', 'published')
                             ->orderBy('views', 'desc')
                             ->take(5)
                             ->get();

        // Nhớ truyền thêm 'trendingPosts' vào view nhé
        return view('frontend.detail', compact('post', 'relatedPosts', 'trendingPosts'));
    }

    public function category($slug)
    {
        // 1. Tìm danh mục dựa vào slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // 2. Lấy các bài viết thuộc danh mục này, mỗi trang hiển thị 6 bài (paginate)
        $posts = Post::where('category_id', $category->id)
                     ->where('status', 'published')
                     ->orderBy('id', 'desc')
                     ->paginate(6);

        // 3. Lấy lại Top 5 bài xem nhiều để nhét vào Sidebar cho đỡ trống
        $trendingPosts = Post::where('status', 'published')
                             ->orderBy('views', 'desc')
                             ->take(5)
                             ->get();

        return view('frontend.category', compact('category', 'posts', 'trendingPosts'));
    }

    public function search(Request $request)
{
    $keyword = $request->input('query');

    // Tìm các bài viết có tiêu đề hoặc nội dung chứa từ khóa
    $posts = Post::where('status', 'published')
                 ->where(function($query) use ($keyword) {
                     $query->where('title', 'LIKE', "%{$keyword}%")
                           ->orWhere('content', 'LIKE', "%{$keyword}%");
                 })
                 ->orderBy('id', 'desc')
                 ->paginate(6);

    // Vẫn lấy tin trending cho Sidebar
    $trendingPosts = Post::where('status', 'published')
                         ->orderBy('views', 'desc')
                         ->take(5)
                         ->get();

    return view('frontend.search', compact('posts', 'keyword', 'trendingPosts'));
}
}
