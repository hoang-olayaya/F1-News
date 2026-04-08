@extends('frontend.layouts.master')

@section('title', 'F1 News - Trang Chủ')

@section('content')
    @if($heroPost)
    <div class="card text-white border-0 mb-5" style="border-radius: 8px; overflow: hidden; min-height: 450px;">
        <img src="{{ asset('storage/' . $heroPost->thumbnail) }}" class="card-img" alt="{{ $heroPost->title }}" style="height: 500px; object-fit: cover; opacity: 0.8;">
        
        <div class="card-img-overlay d-flex flex-column justify-content-end p-lg-5 p-4" style="background: linear-gradient(to top, rgba(21,21,30,1) 0%, rgba(21,21,30,0) 100%);">
            <span class="badge bg-danger mb-3 align-self-start f1-font px-3 py-2 fs-6">
                {{ $heroPost->category ? $heroPost->category->name : 'Tin Nóng' }}
            </span>
            
            <h1 class="card-title f1-font mb-3" style="font-size: 2.8rem; text-shadow: 2px 2px 5px rgba(0,0,0,0.8);">
                <a href="{{ route('post.detail', $heroPost->slug) }}" class="text-decoration-none">{{ $heroPost->title }}</a>
            </h1>
            <p class="card-text d-none d-md-block" style="font-size: 1.1rem; max-width: 800px;">
                {{ Str::limit($heroPost->summary, 200) }}
            </p>
            <p class="card-text">
                <small class="text-white-50"><i class="far fa-clock"></i> {{ $heroPost->created_at->diffForHumans() }}</small>
            </p>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12 mb-4">
            <h3 class="f1-font border-bottom border-danger pb-2" style="border-width: 3px !important; display: inline-block;">TIN TỨC MỚI NHẤT</h3>
        </div>
        
        <div class="row g-4">
            @forelse($latestPosts as $post)
            <div class="col-lg-6">
                <div class="card h-100 border-0" style="background-color: var(--f1-card-bg); border-radius: 8px; overflow: hidden; transition: transform 0.2s;">
                    <div class="row g-0 h-100">
                        <div class="col-md-4 col-4">
                            <a href="{{ route('post.detail', $post->slug) }}">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid rounded-start h-100 w-100" alt="..." style="object-fit: cover; min-height: 120px;">
                            </a>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="card-body d-flex flex-column justify-content-center h-100 py-2 px-3">
                                <h5 class="card-title f1-font mb-2" style="font-size: 1.2rem;">
                                    <a href="{{ route('post.detail', $post->slug) }}" class="text-decoration-none" onmouseover="this.style.color='var(--f1-red)'" onmouseout="this.style.color='var(--f1-text)'">
                                        {{ Str::limit($post->title, 65) }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small mb-0">
                                    <span class="text-danger me-2 f1-font">{{ $post->category ? $post->category->name : '' }}</span>
                                    <i class="far fa-clock"></i> {{ $post->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>Chưa có bài viết nào được xuất bản.</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection