<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{ $title ?? 'Lapo Marpaigon' }}</title>
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
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            background-color: white !important;
        }

        .account-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .account-info-item {
            border-left: none;
            border-right: none;
            padding: 1.25rem 1.5rem;
        }

        .account-info-item:first-child {
            border-top: none;
        }

        .account-info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--muted-color);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .logo-text {
            font-family: 'Arial Rounded MT Bold', 'Arial', sans-serif;
            font-weight: bold;
            color: var(--secondary-color);
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3">
        <div class="container">
            <div class="d-flex align-items-center">
                <form action="{{ url()->route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-left me-1"></i> Logout
                    </button>
                </form>
            </div>

            <div class="mx-auto">
                <h1 class="mb-0 fs-4 fw-bold logo-text">{{ $title ?? 'Lapo Marpaigon' }}</h1>
            </div>

            <div class="d-flex align-items-center">
                <button id="backButton" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </div>
    </header>
    <!-- End of Header Navigation -->

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="account-card p-4 mb-4">
                    <h2 class="text-center mb-4">
                        <i class="bi bi-person-circle me-2"></i>Informasi Akun
                    </h2>

                    <div class="list-group list-group-flush">
                        <!-- Nama -->
                        <div class="account-info-item list-group-item">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ $name ?? 'Name not available' }}</div>
                        </div>

                        <!-- Email -->
                        <div class="account-info-item list-group-item">
                            <div class="info-label">Email Terdaftar</div>
                            <div class="info-value">{{ $email ?? 'Email not available' }}</div>
                        </div>
                        <!-- end of informasi email -->

                        <!-- Password (opsional) -->
                        <!-- <div class="account-info-item list-group-item">
                            <div class="info-label">Password</div>
                            <a href="#" class="text-primary text-decoration-none">
                                <i class="bi bi-key me-1"></i>Ganti Password
                            </a>
                        </div> -->
                        <!-- informasi role -->
                        <div class="account-info-item list-group-item list-group-item-action">

                            <div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 info-label">Role</h5>
                                    <!-- <small class="text-body-secondary">Lorem_ipsum.</small> -->
                                </div>
                                <p class="mb-1">{{ $role ?? "Role not available" }}</p>

                            </div>

                            <div class="d-flex justify-content-between">

                            </div>
                        </div>
                        <!-- end of informasi role -->
                    </div>
                </div>
            </div>
    </main>
    <!-- End of Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('backButton').addEventListener('click', function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ url()->to('home') }}';
            }
        });
    </script>
</body>

</html>