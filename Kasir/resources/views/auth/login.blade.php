

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>

    <link href="{{ asset('Savora/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Savora/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('Savora/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('Savora/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="min-height: 100vh;">

    <main id="main" class="main w-100">
        <div class="container-fluid">
            <div class="row min-vh-100">

          <!-- Sisi Kiri: Login (background putih) -->
                <div class="col-md-6 col-lg-5 bg-white d-flex align-items-center justify-content-center">
                    <div class="w-100 px-4" style="max-width: 420px;">


                        <!-- Judul -->
                        <div class="text-center mb-4">
                            <h4 class="fw-bold mb-0">Login</h4>
                            <small class="text-muted">Masuk untuk melanjutkan</small>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-3" :status="session('status')" />

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg border-1" required autofocus
                                    autocomplete="username">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input id="password" type="password" name="password"
                                    class="form-control form-control-lg border-1" required
                                    autocomplete="current-password">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Remember + Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember_me" class="form-check-label fw-normal">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                {{ __('Log in') }}
                            </button>
                        </form>




                        <!-- Register link -->
                        <div class="text-center mt-3">
                            <small>Belum punya akun?
                                <a href="{{ route('register') }}" class="fw-bold text-primary">Daftar</a>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Gambar / Background -->
                <div class="col-md-6 col-lg-7 d-none d-md-flex align-items-center justify-content-center"
                    style="background-color: #D7CCC8">
                    <img src="{{ asset('images/vektor-logo.png') }}" alt="Login Illustration"
                        class="img-fluid rounded-4 " style="max-height: 500px;">
                </div>

            </div>
        </div>
    </main>

    <!-- Vendor JS -->
    <script src="{{ asset('Savora/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Savora/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Savora/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Savora/assets/js/main.js') }}"></script>

</body>

</html>

        