<x-guest-layout>
    <form method="POST" action="{{ route('registerTrainer') }}">
        @csrf
        <!-- Họ và tên -->
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Địa chỉ Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Địa chỉ Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mật khẩu -->
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Xác nhận mật khẩu -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="text-decoration-none" href="{{ route('login') }}">
                Đã có tài khoản? Đăng nhập ngay
            </a>

            <button type="submit" class="btn btn-primary">
                Đăng ký
            </button>
        </div>
    </form>
</x-guest-layout>
