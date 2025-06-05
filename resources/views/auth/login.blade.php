<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Buku Tamu Inspektorat Provinsi Jawa Timur</title>
    <link rel="icon" href="{{ asset('img/logo-inspektorat2.png') }}" type="image/x-icon">
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
    <style>
    body {
        background: linear-gradient(to right, #003366, #66a3ff);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    .login-title {
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-align: center;
        color: #002244;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #2c5364;
    }

    .btn-primary {
        margin-top: 20px;
        background: #002244;
        border-color: #2c5364;
    }

    .btn-primary:hover {
        background: #001122;
    }

    .password-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
    }

    .toggle-password:hover {
        color: #333;
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 1.5rem;
            max-width: 80%;
        }

        .login-title {
            font-size: 1.5rem;
        }

        .form-control {
            font-size: 0.9rem;
        }

        .btn-primary {
            padding: 0.75rem;
            font-size: 0.9rem;
        }
    }
    </style>
</head>

<body>
    <div class="login-card">
        <h2 class="login-title">Login</h2>

        <!-- Menampilkan pesan error -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form login, method POST, mengarah ke route proses login -->
        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword()" id="togglePassword"></i>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
    </div>

    <!-- Script toggle password visibility -->
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');

        // Cek tipe input password saat ini
        const isPassword = passwordInput.type === 'password';
        // Ganti tipe input password/text untuk menampilkan atau menyembunyikan password
        passwordInput.type = isPassword ? 'text' : 'password';

        // Ganti ikon antara mata terbuka dan tertutup
        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    }
    </script>
</body>

</html>