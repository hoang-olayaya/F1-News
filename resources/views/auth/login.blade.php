@extends('frontend.layouts.master')

@section('title', 'Đăng nhập - F1 News')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-5">
        <div class="card border-0 shadow-lg rounded-3" style="background-color: var(--f1-card-bg);">
            <div class="card-header border-bottom border-danger bg-transparent py-3" style="border-width: 3px !important;">
                <h3 class="f1-font text-white mb-0 text-center">ĐĂNG NHẬP</h3>
            </div>
            
            <div class="card-body p-4 p-md-5">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 bg-danger text-white bg-opacity-75">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted small fw-bold text-uppercase">Email của bạn</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control bg-dark border-secondary text-white py-2">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted small fw-bold text-uppercase">Mật khẩu</label>
                        <input id="password" type="password" name="password" required class="form-control bg-dark border-secondary text-white py-2">
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-f1 py-2 fs-5">TIẾN VÀO ĐƯỜNG ĐUA</button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <span class="text-muted">Chưa có tài khoản?</span> 
                        <a href="{{ route('register') }}" class="text-danger text-decoration-none fw-bold">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection