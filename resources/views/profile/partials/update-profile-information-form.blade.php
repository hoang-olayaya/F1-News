<section class="card bg-dark border-secondary text-white shadow-sm">
    <div class="card-body p-4">
        <header class="mb-4">
            <h2 class="h5 mb-2">{{ __('Thay Đổi Thông Tin Hồ Sơ') }}</h2>

            <p class="text-secondary mb-0">
                {{ __("Cập nhật thông tin hồ sơ tài khoản và địa chỉ email") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="d-flex flex-column gap-3">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="form-label text-white">{{ __('Tên') }}</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @if ($errors->get('name'))
                    @foreach ($errors->get('name') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div>
                <label for="email" class="form-label text-white">{{ __('Email') }}</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                >
                @if ($errors->get('email'))
                    @foreach ($errors->get('email') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="text-light mb-2">
                            {{ __('Địa chỉ email chưa được xác minh') }}

                            <button form="send-verification" type="submit" class="btn btn-link p-0 align-baseline text-decoration-underline text-secondary">
                                {{ __('Nhấp vào đây để gửi lại email xác nhận') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success mb-0">
                                {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-f1">{{ __('Lưu') }}</button>

                @if (session('status') === 'profile-updated')
                    <p class="text-secondary mb-0">{{ __('Lưu Thành Công') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
