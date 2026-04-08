<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage; 

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Post::with('category');

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        $posts = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'slug' => 'nullable|unique:posts,slug',
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            // Bắt buộc phải là file ảnh, định dạng jpeg, png, jpg, gif, webp, tối đa 2MB
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.unique' => 'Tiêu đề này đã tồn tại',
            'thumbnail.image' => 'File tải lên phải là hình ảnh',
            'thumbnail.max' => 'Dung lượng ảnh không được vượt quá 2MB',
        ]);

        $thumbnailPath = '';
        if ($request->hasFile('thumbnail')) {
            // Lưu ảnh vào thư mục storage/app/public/uploads/posts
            $thumbnailPath = $request->file('thumbnail')->store('uploads/posts', 'public');
        }

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        Post::create([
            'user_id' => 1, // Tạm thời gán cứng Tác giả là User có ID = 1 (Vì mình chưa làm chức năng Đăng nhập)
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath, // Chỉ lưu đường dẫn ảnh vào DB
            'status' => $request->status,
            'published_at' => $request->status == 'published' ? now() : null, // Nếu xuất bản thì lưu thời gian hiện tại
        ]);

        return redirect()->route('posts.create')->with('success', 'Đăng bài viết thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('status', 1)->get(); // Lấy lại danh mục để đưa vào Form
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $post->id,
            'slug' => 'nullable|unique:posts,slug,' . $post->id,
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Bỏ required vì người ta có thể không đổi ảnh
        ]);

        // Xử lý ảnh: Nếu có ảnh mới thì lưu ảnh mới, xóa ảnh cũ
        $thumbnailPath = $post->thumbnail; // Mặc định giữ lại đường dẫn ảnh cũ
        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ trong storage (nếu có)
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            // Lưu ảnh mới
            $thumbnailPath = $request->file('thumbnail')->store('uploads/posts', 'public');
        }

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
            'published_at' => $request->status == 'published' && $post->status == 'draft' ? now() : $post->published_at,
        ]);

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        // Bạn đang dùng Soft Deletes (xóa mềm), nên mình chỉ đánh dấu xóa trong DB chứ không xóa mất ảnh vật lý nhé
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Đã chuyển bài viết vào thùng rác!');
    }
}
