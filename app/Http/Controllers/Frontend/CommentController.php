<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // Kiểm tra dữ liệu (không được để trống)
        $request->validate([
            'content' => 'required|max:1000'
        ]);

        // Lưu vào Database
        Comment::create([
            'user_id' => Auth::id(), // Lấy ID của người đang đăng nhập (như OLAYAYA)
            'post_id' => $post_id,
            'content' => $request->content
        ]);

        // Quay lại trang cũ với thông báo thành công
        return back()->with('success', 'Bình luận của bạn đã được gửi!');
    }
}
