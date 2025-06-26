{{-- resources/views/client/profile/partials/update-password-form.blade.php --}}

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Cập nhật mật khẩu
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Đảm bảo tài khoản của bạn sử dụng mật khẩu dài, ngẫu nhiên để luôn an toàn.
        </p>
    </header>

    <form method="post" action="{{ route('client.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put') {{-- Sử dụng phương thức PUT cho cập nhật mật khẩu --}}

        <div>
            <label for="current_password" class="form-label">Mật khẩu hiện tại:</label>
            <input id="current_password" name="current_password" type="password" class="form-control mt-1 block w-full" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label">Mật khẩu mới:</label>
            <input id="password" name="password" type="password" class="form-control mt-1 block w-full" autocomplete="new-password">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới:</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control mt-1 block w-full" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Lưu mật khẩu</button>

            @if (session('status') === 'password-updated') {{-- Sử dụng 'password-updated' để phân biệt trạng thái --}}
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Đã lưu.') }}</p>
            @endif
        </div>
    </form>
</section>