<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Lấy danh sách chuyên mục, sắp xếp mới nhất lên đầu, phân trang 10 dòng/trang
        $categories = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        // Trả về view và truyền biến $categories ra ngoài
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào (Validation)
        $request->validate([
            'name' => 'required|max:255|unique:categories,name',
            'slug' => 'nullable|unique:categories,slug',
        ], [
            'name.required' => 'Vui lòng nhập tên chuyên mục',
            'name.unique' => 'Tên chuyên mục này đã tồn tại',
        ]);

        // 2. Tự động tạo Slug nếu người dùng không nhập
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // 3. Lưu vào Database
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status
        ]);

        // 4. Quay về trang danh sách và báo thành công
        return redirect()->route('categories.index')->with('success', 'Thêm chuyên mục thành công!');
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
        // Tìm danh mục theo ID, nếu không thấy sẽ báo lỗi 404
        $category = Category::findOrFail($id); 
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Validation (Lưu ý: Bỏ qua kiểm tra trùng lặp tên/slug cho chính ID hiện tại)
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|unique:categories,slug,' . $category->id,
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục này đã tồn tại',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Đã xóa danh mục thành công!');
    }
}
