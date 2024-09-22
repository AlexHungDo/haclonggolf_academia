<script type="text/javascript">
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null;};
</script>

<x-guest-layout>
    <style>
        .card {
            background-color: #495057;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
            color: #E7D1B5;
        }
        .btn-primary {
            background-color: #E7D1B5;
            border: none;
            color: #343a40;
        }
        .text-secondary {
            color: #E7D1B5 !important;
        }
        .text-success {
            color: #E7D1B5 !important;
        }
    </style>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-start ">
        <div class="w-100" style="max-width: 400px;">
            <div class="card p-4">
                <h2 class="text-center mb-4">Đăng nhập</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Tài khoản</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @if ($errors->has('email'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                        @if ($errors->has('password'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember_me">Ghi nhớ</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none text-secondary" href="{{ route('password.request') }}">
                                Bạn quên mật khẩu?
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            Đăng nhập
                        </button>
                    </div>

                    <!-- Đăng ký ngay -->
                    <div class="mt-3 text-center">
                        <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none text-success">Đăng ký ngay</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
