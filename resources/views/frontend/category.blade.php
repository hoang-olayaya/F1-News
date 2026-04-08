@extends('frontend.layouts.master')

@section('title', 'Chuyên mục: ' . $category->name . ' - F1 News')

@section('content')
<div class="row">
    <div class="col-lg-8 pe-lg-5">
        
        <div class="mb-5 border-bottom border-danger pb-3" style="border-width: 3px !important;">
            <span class="text-muted text-uppercase small fw-bold">DANH MỤC</span>
            <h1 class="f1-font mt-2" style="font-size: 2.5rem;">{{ $category->name }}</h1>
        </div>

        <div class="row g-4 mb-5">
            @forelse($posts as $post)
            <div class="col-md-6">
                <div class="card h-100 bg-transparent border-0">
                    <a href="{{ route('post.detail', $post->slug) }}" class="text-decoration-none">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top rounded mb-3 w-100 shadow-sm" alt="..." style="height: 200px; object-fit: cover;">
                        <h5 class="card-title f1-font transition-color" style="font-size: 1.3rem; line-height: 1.4;" onmouseover="this.style.color='var(--f1-red)'" onmouseout="this.style.color='var(--f1-text)'">
                            {{ Str::limit($post->title, 70) }}
                        </h5>
                    </a>
                    <div class="mt-2 text-muted small">
                        <i class="far fa-clock"></i> {{ $post->created_at->format('d/m/Y') }} 
                        <span class="mx-2">|</span> 
                        <i class="far fa-eye"></i> {{ $post->views }}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="fas fa-folder-open fs-1 mb-3"></i>
                <p>Chưa có bài viết nào trong danh mục này.</p>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center pt-4 border-top border-secondary">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="col-lg-4 mt-5 mt-lg-0">
        <div class="card border-0 rounded-3 p-4 shadow-sm sticky-top" style="background-color: var(--f1-card-bg); top: 90px;">
            <h4 class="f1-font border-bottom border-danger pb-2 mb-0" style="border-width: 3px !important;">ĐỌC NHIỀU NHẤT</h4>
            <div class="list-group list-group-flush mt-3 bg-transparent">
                @foreach($trendingPosts as $index => $trending)
                <a href="{{ route('post.detail', $trending->slug) }}" class="list-group-item list-group-item-action bg-transparent border-bottom border-secondary px-0 py-3">
                    <div class="d-flex align-items-center">
                        <h1 class="f1-font text-danger me-3 mb-0 opacity-75">#{{ $index + 1 }}</h1>
                        <div>
                            <h6 class="mb-1 fw-bold" style="font-size: 1rem;" onmouseover="this.style.color='var(--f1-red)'" onmouseout="this.style.color='var(--f1-text)'">
                                {{ Str::limit($trending->title, 55) }}
                            </h6>
                            <small class="text-muted"><i class="far fa-eye"></i> {{ $trending->views }} lượt xem</small>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection