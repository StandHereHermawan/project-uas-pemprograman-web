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

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color);
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            background-color: white !important;
        }

        .nav-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .offcanvas-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            background-color: #f1f1f1;
        }

        .card-title {
            font-weight: 600;
            color: var(--primary-color);
        }

        .price {
            color: var(--secondary-color);
            font-weight: 700;
        }

        .stock {
            color: var(--muted-color);
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        .btn-outline-secondary {
            border-radius: 5px;
        }

        .page-item.active .page-link {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .page-link {
            color: var(--secondary-color);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--secondary-color);
        }

        .offcanvas-body {
            padding: 1rem 1.5rem;
        }

        .logo-text {
            font-family: 'Arial Rounded MT Bold', 'Arial', sans-serif;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .placeholder-img {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f1f1;
            color: #999;
            font-size: 0.9rem;
        }

        .hero-carousel {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .carousel-item {
            height: 400px;
            background-color: #f1f1f1;
        }

        .carousel-img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .carousel-caption {
            background-color: rgba(44, 62, 80, 0.7);
            border-radius: 5px;
            padding: 1.5rem;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-indicators button {
            background-color: var(--primary-color);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
            border: none;
        }

        .carousel-indicators button.active {
            background-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .carousel-item {
                height: 250px;
            }

            .carousel-caption {
                padding: 1rem;
                bottom: 1rem;
            }

            .carousel-caption h5 {
                font-size: 1rem;
            }

            .carousel-caption p {
                font-size: 0.8rem;
                display: none;
                /* Sembunyikan deskripsi di mobile */
            }
        }
    </style>
</head>

<body>
    <!-- upper navbar - Perbaikan -->
    <header class="py-3 mb-4 border-bottom shadow-sm sticky-top bg-white">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-2 mb-lg-0">
                <i class="bi bi-shop fs-3 text-primary me-2"></i>
                <span class="fs-4 fw-bold logo-text">{{ $shopName ?? 'Lapo Marpaigon' }}</span>
            </div>

            <div class="col-12 col-lg-auto">
                <div class="d-flex justify-content-center mb-3 mb-lg-0 me-3">
                    <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor"
                            class="bi bi-card-list me-2" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- offcanvas baru muncul kalau klik tombol navigation. -->
    <div class="offcanvas offcanvas-start shadow-lg" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">

        <div class="offcanvas-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="offcanvas-title mb-0" id="offcanvasScrollingLabel">
                    <i class="bi bi-shop me-2"></i>{{ $title ?? 'Lapo Marpaigon' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>

        <div class="offcanvas-body">
            <p>{{$offCanvaHeader ?? "Lapo Marpaigon dalam bahasa batak artinya toko makanan."}}</p>
            <!-- first accordion -->
            <div class="accordion mb-3" id="accordionExample1">
                @if ($userRole === "SELLER")

                    <div class="accordion-item">
                        <h2 class="accordion-header">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-box2-heart me-2" viewBox="0 0 16 16">
                                    <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982" />
                                    <path
                                        d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z" />
                                </svg>
                                Produk
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="{{ url()->route('add-product') }}" method="get"
                                    class="d-flex justify-content-center mb-3 mb-lg-0">
                                    <button class="btn btn-outline-dark w-100" type="submit" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                        Tambah Produk
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endif

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed px-4 py-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseShopping" aria-expanded="false" aria-controls="collapseShopping">
                            <i class="bi bi-cart3 me-3"></i>Belanja
                        </button>
                    </h2>
                    <div id="collapseShopping" class="accordion-collapse collapse" data-bs-parent="#mainMenuAccordion">
                        <div class="accordion-body px-4 py-3">
                            <form action="{{ url()->to('payment-status') }}" method="get" class="mb-2">
                                <button class="btn btn-outline-dark w-100 py-2 px-3 text-start" type="submit">
                                    <i class="bi bi-clock-history me-2"></i>Histori Belanja
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- User Section -->
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed px-4 py-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                            <i class="bi bi-person me-3"></i>Akun Pengguna
                        </button>
                    </h2>
                    <div id="collapseUser" class="accordion-collapse collapse" data-bs-parent="#mainMenuAccordion">
                        <div class="accordion-body px-4 py-3">
                            <form action="{{ url()->to('account') }}" method="get" class="mb-2">
                                <button class="btn btn-outline-dark w-100 py-2 px-3 text-start" type="submit">
                                    <i class="bi bi-person-circle me-2"></i>Akun Pribadi
                                </button>
                            </form>
                            <form action="{{ url()->route('logout') }}" method="post" class="mb-0">
                                @csrf
                                <button class="btn btn-outline-danger w-100 py-2 px-3 text-start" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Menu Accordion -->
        </div>
    </div>
    <!-- End of Offcanvas Menu -->

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Hero Carousel -->
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="https://thumb.viva.id/vivapurwasuka/1265x711/2025/01/12/67833b3fd2462-gehu-pedas_purwasuka.jpg"
                        class="d-block w-100 carousel-img" alt="Promo Spesial">
                    <div class="carousel-caption text-start">
                        <h5>Promo Spesial Hari Ini</h5>
                        <p>Dapatkan diskon hingga 30% untuk produk pilihan</p>
                        <a href="#" class="btn btn-primary btn-sm">Lihat Promo</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="https://thumb.viva.id/vivabandung/1265x711/2025/02/21/67b84865b58de-batagor-khas-bandung_bandung.jpg"
                        class="d-block w-100 carousel-img" alt="Produk Terbaru">
                    <div class="carousel-caption">
                        <h5>Produk Terbaru</h5>
                        <p>Temukan koleksi terbaru kami yang segar dan lezat</p>
                        <a href="#" class="btn btn-primary btn-sm">Jelajahi</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="https://mediapijar.com/wp-content/uploads/2017/11/Cireng-Rujak-at-Armor-Kopi-Bandung-by-Myfunfoodiary-03-fb.jpg"
                        class="d-block w-100 carousel-img" alt="Pengiriman Cepat">
                    <div class="carousel-caption text-end">
                        <h5>Pengiriman Kilat</h5>
                        <p>Pesanan Anda akan sampai dalam waktu 2 jam</p>
                        <a href="#" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- End Hero Carousel -->

        <!-- Bagian produk tetap sama -->
        <div class="row">
            @if (isset($barang) && is_iterable($barang))
                <!-- Pagination -->
                <div class="mb-4">
                    {{ $barang->onEachSide(3)->links() }}
                </div>

                <!-- Product Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($barang as $item)
                        <div class="col">
                            <div class="card h-100 shadow">
                                <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="140"
                                    preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $item->getNamaBarang() }}</h5>
                                        <span
                                            class="price">Rp{{ number_format($item->getHarga(), 0, ',', '.') }}</span>
                                    </div>
                                    <p class="stock mb-3">Stok: {{ $item->stock->jumlah ?? '0' }}</p>
                                    <form action="/detail-item" method="get">
                                        <input type="hidden" name="id" value="{{ $item->getId() }}">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Beli
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End of Product Grid -->
            @else
                <!-- Empty State -->
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam display-4 text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada produk tersedia</h4>
                    <p class="text-muted">Silakan kembali lagi nanti</p>
                </div>
            @endif
        </div>
    </main>
    <!-- End of Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
