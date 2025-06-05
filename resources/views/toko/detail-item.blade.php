<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{ $title ?? 'Detail Produk' }}</title>
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

        .product-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }

        .product-image {
            height: 300px;
            object-fit: cover;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted-color);
        }

        .price-tag {
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .info-label {
            color: var(--muted-color);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .logo-text {
            font-family: 'Arial Rounded MT Bold', 'Arial', sans-serif;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .quantity-input {
            display: flex;
            align-items: center;
            max-width: 150px;
        }

        .quantity-input .btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .quantity-input .btn:first-child {
            border-radius: 5px 0 0 5px;
        }

        .quantity-input .btn:last-child {
            border-radius: 0 5px 5px 0;
        }

        .quantity-input input {
            width: 60px;
            height: 40px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
            border-left: none;
            border-right: none;
        }

        .quantity-input input:focus {
            outline: none;
            box-shadow: none;
            border-color: #dee2e6;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3">
        <div class="container">
            <div class="d-flex align-items-center">
                <button onclick="window.history.back()" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </button>
            </div>

            <div class="mx-auto">
                <h1 class="mb-0 fs-4 fw-bold logo-text">{{ $shopName ?? 'Lapo Marpaigon' }}</h1>
            </div>

            <div class="d-flex align-items-center">
                <form action="{{ url()->to('home') }}" method="get">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-house-door me-1"></i> Home
                    </button>
                </form>
            </div>
        </div>
    </header>
    <!-- End of Header Navigation -->

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="product-image rounded-3 mb-4">
                    [Gambar Produk]
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product-card p-4 h-100">
                    <h2 class="mb-4">{{ $namaBarang ?? 'Nama Produk' }}</h2>

                    <div class="mb-4">
                        <div class="info-label">Harga</div>
                        <div class="price-tag">
                            Rp{{ number_format($hargaBarang ?? 0, 0, ',', '.') }} per satuan
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="info-label">Stok Tersedia</div>
                        <div class="info-value">{{ $jumlah ?? '0' }}</div>
                    </div>

                    <form action="{{ url()->current() }}" method="post">
                        @csrf

                        <div class="mb-4">
                            <div class="info-label">Nama Pembeli</div>
                            <div class="info-value">{{ $namaPembeli ?? 'Guest' }}</div>
                            <input type="hidden" name="buyers" value="{{ $namaPembeli }}">
                            <input type="hidden" name="buyers-id" value="{{ $idPembeli }}">
                            <input type="hidden" name="goodsId" value="{{ $idBarang ?? '0' }}">
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label info-label">Jumlah Pembelian</label>
                            <div class="quantity-input">
                                <button type="button" class="btn btn-minus">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="1"
                                    min="1" max="{{ $jumlah ?? '' }}">
                                <button type="button" class="btn btn-plus">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            @if ($errors->has('quantity'))
                                <div class="text-danger small mt-1">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-cart-plus me-1"></i> Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- End of Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const btnMinus = document.querySelector('.btn-minus');
            const btnPlus = document.querySelector('.btn-plus');
            const maxStock = parseInt(quantityInput.getAttribute('max')) || Infinity;

            btnMinus.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });

            btnPlus.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value < maxStock) {
                    quantityInput.value = value + 1;
                }
            });

            quantityInput.addEventListener('change', function() {
                let value = parseInt(this.value);
                if (isNaN(value) || value < 1) {
                    this.value = 1;
                } else if (value > maxStock) {
                    this.value = maxStock;
                }
            });
        });
    </script>
</body>

</html>
