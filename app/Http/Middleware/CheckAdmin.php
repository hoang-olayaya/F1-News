<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Nhớ thêm dòng này

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem đã đăng nhập chưa VÀ có phải là admin không
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Nếu đúng là sếp, mời vào!
            return $next($request);
        }

        // Nếu là user bình thường hoặc chưa đăng nhập, đuổi cổ về Trang chủ kèm thông báo
        return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này!');
    }
}
