@extends('admin.layouts.master')

@section('title', 'Quản lý Danh mục')
@section('page-title', 'Danh sách Danh mục')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Thêm danh mục mới
                </a>

                <form action="{{ route('categories.index') }}" method="GET" class="d-flex" role="search">
                    <div class="input-group input-group-sm" style="max-width: 320px;">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Tìm theo tên danh mục..."
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary" title="Xóa từ khóa tìm kiếm">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Đường dẫn tĩnh (Slug)</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge text-bg-success">Hiển thị</span>
                                @else
                                    <span class="badge text-bg-secondary">Đang ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
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
                            <td colspan="5" class="text-center">Chưa có dữ liệu danh mục nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection