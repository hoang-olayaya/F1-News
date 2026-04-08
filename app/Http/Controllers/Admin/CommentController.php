<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Hiển thị danh sách tất cả bình luận
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Comment::with(['user', 'post']);

        if ($search) {
            $query->where('content', 'LIKE', "%{$search}%");
        }

        // Lấy tất cả bình luận, kèm theo thông tin User (người đăng) và Post (bài viết)
        $comments = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

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