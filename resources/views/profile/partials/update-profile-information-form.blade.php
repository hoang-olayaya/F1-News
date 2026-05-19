<section class="card bg-body border-body-secondary text-body shadow-sm">
    <div class="card-body p-4">
        <header class="mb-4">
            <h2 class="h5 mb-2">{{ __('Thay Đổi Thông Tin Hồ Sơ') }}</h2>

            <p class="text-body-secondary mb-0">
                {{ __("Cập nhật thông tin hồ sơ tài khoản và địa chỉ email") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="d-flex flex-column gap-3" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="form-label">{{ __('Tên') }}</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
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
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
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
                        <p class="text-body mb-2">
                            {{ __('Địa chỉ email chưa được xác minh') }}

                            <button form="send-verification" type="submit" class="btn btn-link p-0 align-baseline text-decoration-underline text-body-secondary">
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

            <div>
                <label for="avatar" class="form-label">{{ __('Hình Đại Diện') }}</label>
                <div class="mb-3">
                    @if($user->avatar)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAvatarModal">
                            {{ __('Xóa Hình Đại Diện') }}
                        </button>
                    @else
                        <p class="text-body-secondary mb-3">{{ __('Chưa có hình đại diện') }}</p>
                    @endif
                </div>
                <input
                    id="avatar"
                    name="avatar"
                    type="file"
                    class="form-control @error('avatar') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/webp"
                >
                <small class="text-body-secondary d-block mt-2">{{ __('Định dạng: JPG, PNG, WebP. Kích thước tối đa: 2MB') }}</small>
                @if ($errors->get('avatar'))
                    @foreach ($errors->get('avatar') as $message)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @endforeach
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-f1">{{ __('Lưu') }}</button>

                @if (session('status') === 'profile-updated')
                    <p class="text-body-secondary mb-0">{{ __('Lưu Thành Công') }}</p>
                @endif
            </div>
        </form>

        <!-- Delete Avatar Modal -->
        <div class="modal fade" id="deleteAvatarModal" tabindex="-1" aria-labelledby="deleteAvatarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-body text-body border-body-secondary">
                    <form method="post" action="{{ route('profile.delete-avatar') }}">
                        @csrf
                        @method('delete')

                        <div class="modal-header border-body-secondary">
                            <h5 class="modal-title" id="deleteAvatarLabel">{{ __('Xóa Hình Đại Diện') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                        </div>

                        <div class="modal-body">
                            <p>{{ __('Bạn có chắc chắn muốn xóa hình đại diện không? Hành động này không thể hoàn tác.') }}</p>
                        </div>

                        <div class="modal-footer border-body-secondary">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                {{ __('Hủy') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Xóa') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
