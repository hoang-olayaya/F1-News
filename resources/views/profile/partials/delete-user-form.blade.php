<section class="card bg-dark border-secondary text-white shadow-sm">
    <div class="card-body p-4">
        <header class="mb-4">
            <h2 class="h5 mb-2">
                {{ __('Xóa Tài Khoản') }}
            </h2>

            <p class="text-secondary mb-0">
                {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu trong đó sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào bạn muốn giữ lại.') }}
            </p>
        </header>

        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            {{ __('Xóa Tài Khoản') }}
        </button>
    </div>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white border-secondary">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-secondary">
                        <h2 class="modal-title fs-5" id="confirmUserDeletionLabel">
                            {{ __('Bạn có chắc chắn muốn xóa tài khoản của mình không?') }}
                        </h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-secondary">
                            {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu trong đó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận rằng bạn muốn xóa vĩnh viễn tài khoản của mình.') }}
                        </p>

                        <div>
                            <label for="password" class="form-label text-white">{{ __('Password') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control bg-dark text-white border-secondary @if($errors->userDeletion->get('password')) is-invalid @endif"
                                placeholder="{{ __('Password') }}"
                            >

                            @if ($errors->userDeletion->get('password'))
                                @foreach ($errors->userDeletion->get('password') as $message)
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalElement = document.getElementById('confirmUserDeletionModal');
                if (modalElement) {
                    var deletionModal = new bootstrap.Modal(modalElement);
                    deletionModal.show();
                }
            });
        </script>
    @endif
</section>
