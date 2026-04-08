@extends('admin.layouts.master')

@section('title', 'Thêm Danh Mục')
@section('page-title', 'Thêm Danh Mục Mới')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf 
                @method('PUT')
                @csrf <div class="card-body">
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
                        <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Đường dẫn tĩnh (Slug)</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-default float-end">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection