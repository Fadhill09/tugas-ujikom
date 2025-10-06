<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register</title>

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

                <!-- Sisi Kanan: Register Form -->
                <div class="col-md-6 col-lg-7 d-none d-md-flex align-items-center justify-content-center text-white"
                    style="background-color: #D7CCC8">
                    <img src="{{ asset('images/vektor-logo.png') }}" alt="Register Illustration"
                        class="img-fluid rounded-4" style="max-height: 500px;">
                </div>


                <!-- Sisi Kiri: Gambar / Background-->
                <div class="col-md-6 col-lg-5 bg-white d-flex align-items-center justify-content-center">
                    <div class="w-100 px-4" style="max-width: 420px;">

                        <!-- Judul -->
                        <div class="text-center mb-4">
                            <h4 class="fw-bold mb-0">Register</h4>
                            <small class="text-muted">Buat akun baru untuk melanjutkan</small>
                        </div>

                        <!-- Form Register -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nama -->
                            <div class="mb-3 ">
                                <x-input-label for="name" :value="__('Nama')" class="form-label fw-semibold" />
                                <x-text-input id="name" type="text" name="name" :value="old('name')" required
                                    autofocus autocomplete="name" class="form-control form-control-lg border-1" />
                                <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email')" class="form-label fw-semibold" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                                    autocomplete="username" class="form-control form-control-lg border-1" />
                                <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <x-input-label for="password" :value="__('Password')" class="form-label fw-semibold" />
                                <x-text-input id="password" type="password" name="password" required
                                    autocomplete="new-password" class="form-control form-control-lg border-1" />
                                <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                    class="form-label fw-semibold" />
                                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                    required autocomplete="new-password"
                                    class="form-control form-control-lg border-1" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mt-1" />
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                <Small class="small text-decoration-none"> Sudah punya akun?
                                    <a href="{{ route('login') }}" class="fw-bold text-primary">Login</a>
                                </Small>
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
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
