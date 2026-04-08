@extends('admin.layouts.master')

@section('title', 'Quản lý Bài viết')
@section('page-title', 'Danh sách Bài viết')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Đăng bài viết mới
                </a>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Chuyên mục</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="thumbnail" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="text-muted">Không có ảnh</span>
                                @endif
                            </td>
                            <td title="{{ $item->title }}">{{ Str::limit($item->title, 40) }}</td>
                            
                            <td>{{ $item->category ? $item->category->name : 'Không xác định' }}</td>
                            
                            <td>
                                @if($item->status == 'published')
                                    <span class="badge text-bg-success">Đã xuất bản</span>
                                @else
                                    <span class="badge text-bg-warning">Lưu nháp</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('posts.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có bài viết nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection