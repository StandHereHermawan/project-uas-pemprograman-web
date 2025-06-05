<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{ $title ?? 'Login' }}</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color: #333;
            --muted-color: #6c757d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
        }

        .btn-login {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 0;
            font-weight: 500;
        }

        .btn-login:hover {
            background-color: #c0392b;
            color: white;
        }

        .login-header {
            color: var(--primary-color);
            font-weight: 600;
        }

        .form-text {
            color: var(--muted-color);
            font-size: 0.85rem;
        }

        .register-link {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main class="container my-auto py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-card p-4 p-md-5">
                    <!-- Logo/Header -->
                    <div class="text-center mb-4">
                        <i class="bi bi-shop fs-1 text-secondary"></i>
                        <h1 class="login-header mt-2">{{ $shopName ?? 'Lapo Marpaigon' }}</h1>
                    </div>

                    <h2 class="text-center mb-4">{{ $header ?? 'Login' }}</h2>

                    <form id="loginForm" method="post">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control py-2" name="email" id="email"
                                placeholder="alamat@email.com" value="{{ old('email') }}" required>
                            <div class="form-text">Contoh: iamlucky@gmail.com</div>
                            @if ($errors->has('email'))
                                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password-input" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control py-2" name="password" id="password-input"
                                    placeholder="Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Contoh: Rahasia@12345</div>
                            @if ($errors->has('password'))
                                <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-login w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Log In
                        </button>

                        <!-- Registration Link -->
                        <div class="text-center">
                            <p class="mb-0">Belum punya akun?
                                <a href="{{ url()->route('registration') }}" class="register-link">
                                    Registrasi disini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password-input');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>
