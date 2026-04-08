<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Hiển thị danh sách tất cả bình luận
    public function index()
    {
        // Lấy tất cả bình luận, kèm theo thông tin User (người đăng) và Post (bài viết)
        $comments = Comment::with(['user', 'post'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    // Xóa bình luận
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        
        return back()->with('success', 'Đã xóa bình luận thành công!');
    }
}