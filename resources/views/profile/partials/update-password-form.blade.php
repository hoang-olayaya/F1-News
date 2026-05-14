<section class="card bg-body border-body-secondary text-body shadow-sm">
    <div class="card-body p-4">
        <header class="mb-4">
            <h2 class="h5 mb-2">{{ __('Thay Đổi Mật Khẩu') }}</h2>

            <p class="text-body-secondary mb-0">
                {{ __('Hãy đảm bảo tài khoản của bạn sử dụng mật khẩu dài và ngẫu nhiên để giữ an toàn') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="d-flex flex-column gap-3">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password" class="form-label">{{ __('Mật Khẩu Hiện Tại') }}</label>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="form-control @if($errors->updatePassword->get('current_password')) is-invalid @endif"
                    autocomplete="current-password"
                >
                @if ($errors->updatePassword->get('current_password'))
                    @foreach ($errors->updatePassword->get('current_password') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div>
                <label for="update_password_password" class="form-label">{{ __('Mật Khẩu Mới') }}</label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="form-control @if($errors->updatePassword->get('password')) is-invalid @endif"
                    autocomplete="new-password"
                >
                @if ($errors->updatePassword->get('password'))
                    @foreach ($errors->updatePassword->get('password') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div>
                <label for="update_password_password_confirmation" class="form-label">{{ __('Xác Nhận Mật Khẩu') }}</label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
                    autocomplete="new-password"
                >
                @if ($errors->updatePassword->get('password_confirmation'))
                    @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-f1">{{ __('Lưu') }}</button>

                @if (session('status') === 'password-updated')
                    <p class="text-body-secondary mb-0">{{ __('Lưu Thành Công') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
