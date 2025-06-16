<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Thông tin cá nhân
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Cập nhật tên, địa chỉ email và tên đăng nhập của bạn.
        </p>
    </header>

    <form method="post" action="{{ route('client.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="ho_ten" class="form-label">Họ và Tên:</label> {{-- Đổi nhãn cho rõ ràng --}}
            {{-- THAY ĐỔI TÊN Ở ĐÂY --}}
            <input id="ho_ten" name="ho_ten" type="text" class="form-control mt-1 block w-full" value="{{ old('ho_ten', $user->ho_ten) }}" required autofocus autocomplete="name">
            @error('ho_ten') {{-- Đổi tên lỗi ở đây --}}
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label">Email:</label>
            <input id="email" name="email" type="email" class="form-control mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Địa chỉ email của bạn chưa được xác minh.
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Nhấn vào đây để gửi lại email xác minh.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="ten_dang_nhap" class="form-label">Tên đăng nhập:</label>
            <input id="ten_dang_nhap" name="ten_dang_nhap" type="text" class="form-control mt-1 block w-full" value="{{ old('ten_dang_nhap', $user->ten_dang_nhap) }}" required autocomplete="username">
            @error('ten_dang_nhap')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Lưu</button>

            @if (session('status') === 'profile-updated')
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