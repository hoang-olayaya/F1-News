@extends('admin.layouts.master')

@section('title', 'Thêm Bài viết')
@section('page-title', 'Sửa Bài Viết')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">    
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Nhập tiêu đề bài viết..." required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Đường dẫn tĩnh (Slug)</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Tự động tạo nếu để trống">
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Tóm tắt bài viết (Summary) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary', $post->summary) }}</textarea>                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung chi tiết <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id') ?? $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Ảnh Thumbnail</label>
                        @if($post->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current Thumbnail" style="width: 100%; border-radius: 4px;">
                            </div>
                        @endif
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*">
                        <small class="form-text text-muted">Bỏ trống nếu không muốn thay đổi ảnh.</small>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Xuất bản ngay</option>
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Lưu nháp</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-save"></i> Cập nhật bài viết
                    </button>
                    <a href="/admin" class="btn btn-default w-100">Hủy bỏ</a>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        color: #212529 !important;
        background-color: #ffffff !important;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Khởi tạo CKEditor cho thẻ textarea có id="content"
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: "{{ route('admin.editor.upload') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection