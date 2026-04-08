@extends('frontend.layouts.master')

@section('title', $post->title . ' - F1 News')

@section('content')
<style>
    .post-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 15px 0; }
    .post-content p { margin-bottom: 1.2rem; }
</style>

<div class="row">
    <div class="col-lg-8 pe-lg-5">
        
        <a href="#" class="badge bg-danger mb-3 f1-font px-3 py-2 fs-6 text-decoration-none">
            {{ $post->category ? $post->category->name : 'Tin Nóng' }}
        </a>

        <h1 class="f1-font mb-3 fw-bold" style="font-size: 2.5rem;">{{ $post->title }}</h1>

        <div class="d-flex text-muted mb-4 small border-bottom border-secondary pb-3">
            <div class="me-4"><i class="far fa-clock"></i> {{ $post->created_at->format('H:i - d/m/Y') }}</div>
            <div><i class="far fa-eye"></i> {{ $post->views }} lượt xem</div>
        </div>

        <p class="lead fw-bold mb-4" style="font-size: 1.2rem;">
            {{ $post->summary }}
        </p>

        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid rounded mb-5 w-100 shadow" alt="{{ $post->title }}">
        @endif

        <div class="post-content mb-5" style="line-height: 1.8; font-size: 1.15rem;">
            {!! $post->content !!}
        </div>

        <hr class="border-secondary mb-4">
        <h3 class="f1-font border-bottom border-danger pb-2 d-inline-block mb-4" style="border-width: 3px !important;">TIN TỨC LIÊN QUAN</h3>
        <div class="row g-4">
            @forelse($relatedPosts as $related)
                <div class="col-md-6">
                    <div class="card h-100 bg-transparent border-0">
                        <a href="{{ route('post.detail', $related->slug) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/' . $related->thumbnail) }}" class="card-img-top rounded mb-2" alt="..." style="height: 160px; object-fit: cover;">
                            <h6 class="card-title f1-font transition-color" style="font-size: 1.1rem; line-height: 1.4;" onmouseover="this.style.color='var(--f1-red)'" onmouseout="this.style.color='var(--f1-text)'">
                                {{ Str::limit($related->title, 60) }}
                            </h6>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">Chưa có bài viết liên quan nào.</p>
            @endforelse
        </div>

        <hr class="border-secondary my-5">
        <h3 class="f1-font border-bottom border-danger pb-2 d-inline-block mb-4" style="border-width: 3px !important;">
            BÌNH LUẬN ({{ $post->comments->count() }})
        </h3>

        @if(session('success'))
            <div class="alert alert-success bg-success text-white border-0 bg-opacity-75 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @auth
            <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mb-5">
                @csrf
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 35px; height: 35px;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
                    </div>
                    <textarea name="content" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Nhập bình luận của bạn về bài viết này..." required></textarea>
                </div>
                <button type="submit" class="btn btn-f1 px-4">GỬI BÌNH LUẬN</button>
            </form>
        @else
            <div class="alert border-secondary text-center mb-5" style="background-color: var(--f1-card-bg);">
                <p class="text-muted mb-2">Bạn cần đăng nhập để tham gia thảo luận.</p>
                <a href="{{ route('login') }}" class="btn btn-outline-light f1-font px-4">ĐĂNG NHẬP NGAY</a>
            </div>
        @endauth

        <div class="comment-list mt-4">
            @forelse($post->comments as $comment)
                <div class="d-flex mb-4">
                    <div class="me-3">
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 45px; height: 45px; font-size: 1.1rem;">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="p-3 rounded" style="background-color: var(--f1-card-bg);">
                            <h6 class="fw-bold mb-1">
                                {{ $comment->user->name }} 
                                <span class="text-muted small ms-2 fw-normal"><i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</span>
                            </h6>
                            <p class="mb-0" style="font-size: 0.95rem;">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <i class="far fa-comments fs-1 mb-3 opacity-50"></i>
                    <p>Chưa có bình luận nào. Hãy là người đầu tiên "bóc tem" bài viết này!</p>
                </div>
            @endforelse
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
                            <h6 class="mb-1 fw-bold" style="font-size: 1rem; transition: color 0.2s;" onmouseover="this.style.color='var(--f1-red)'" onmouseout="this.style.color='var(--f1-text)'">
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