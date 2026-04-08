@extends('admin.layouts.master')

@section('title', 'Quản lý Bình luận')
@section('page-title', 'Danh sách Bình luận từ Độc giả')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-body table-responsive p-0">
                @if(session('success'))
                    <div class="alert alert-success m-2">{{ session('success') }}</div>
                @endif

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người gửi</th>
                            <th>Nội dung bình luận</th>
                            <th>Bài viết</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->user->name }}</strong></td>
                            <td style="white-space: normal; min-width: 250px;">{{ $item->content }}</td>
                            <td style="white-space: normal; min-width: 200px;">
                                <a href="{{ route('post.detail', $item->post->slug) }}" target="_blank">
                                    {{ Str::limit($item->post->title, 50) }}
                                </a>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('comments.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">
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
                            <td colspan="6" class="text-center">Chưa có bình luận nào trên hệ thống.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer clearfix">
                {{ $comments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection