@extends('frontend.layouts.master')

@section('title', 'Đăng ký tài khoản - F1 News')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-3" style="background-color: var(--f1-card-bg);">
            <div class="card-header border-bottom border-danger bg-transparent py-3" style="border-width: 3px !important;">
                <h3 class="f1-font text-white mb-0 text-center">TẠO TÀI KHOẢN MỚI</h3>
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

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label text-muted small fw-bold text-uppercase">Tên hiển thị</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control bg-dark border-secondary text-white py-2">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label text-muted small fw-bold text-uppercase">Địa chỉ Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control bg-dark border-secondary text-white py-2">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label text-muted small fw-bold text-uppercase">Mật khẩu</label>
                            <input id="password" type="password" name="password" required class="form-control bg-dark border-secondary text-white py-2">
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <label for="password_confirmation" class="form-label text-muted small fw-bold text-uppercase">Xác nhận Mật khẩu</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control bg-dark border-secondary text-white py-2">
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-f1 py-2 fs-5">ĐĂNG KÝ THÀNH VIÊN</button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <span class="text-muted">Đã có tài khoản?</span> 
                        <a href="{{ route('login') }}" class="text-white text-decoration-none fw-bold border-bottom border-danger pb-1">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection