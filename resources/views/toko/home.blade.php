<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <title>{{$title ?? "Lapo Marpaigon"}}</title>
    <style>
        .bs-max-card-height-20rem {
            max-height: 20rem;
        }
    </style>
</head>

<body>
    <!-- upper navbar -->
    <header class="py-3 mb-4 border-bottom shadow sticky-top bg-body">
        <div class="container d-flex flex-wrap justify-content-center">
            <div href="#"
                class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart4"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg> <span class="ms-2 fs-3">{{ $shopName ?? "Lapo Marpaigon" }}</span>
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
    <!-- end of upper navbar -->

    <!-- offcanvas baru muncul kalau klik tombol navigation. -->
    <div class="offcanvas offcanvas-start shadow-lg" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">

        <div class="offcanvas-header">
            <div class="container-fluid row">
                <div class="col">
                    <h5 class="offcanvas-title text-dark" id="offcanvasScrollingLabel">{{$title ?? "Lapo Marpaigon"}}
                    </h5>
                </div>

                <div class="col-1">
                    <div class="pt-2">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- sidebar -->
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
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-bag-check me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                            Belanja
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ url()->to('payment-status') }}" method="get"
                                class="d-flex justify-content-center mb-3 mb-lg-0">
                                <button class="btn btn-outline-dark w-100" type="submit" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                    Histori Belanja
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-person me-2" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                            Bagian Pengguna
                        </button>
                    </h2>
                    <div id="collapseOne1" class="accordion-collapse collapse" data-bs-parent="#accordionExample1">
                        <div class="accordion-body">
                            <form action="{{ url()->to('account') }}" method="get"
                                class="d-flex justify-content-center mb-3 mb-lg-0">
                                <button class="btn btn-outline-dark w-100" type="submit" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                    Akun Pribadi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of first accordion -->
        </div>
        <!-- end of sidebar -->
    </div>
    <!-- offcanvas baru muncul kalau klik tombol navigation. -->

    <!-- barang jualan -->
    <div class="container">
        <div class="col">


            @if (isset($barang) && is_iterable($barang))

                <div>{{ $barang->onEachSide(3)->links() }}</div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">

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
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="card-title">
                                            {{ $item->getNamaBarang() }}
                                        </h5>
                                        <h5 class="card-title opacity-50">
                                            {{ "Rp" . $item->getHarga() }}
                                        </h5>
                                    </div>
                                    <div>
                                        <h6 class="opacity-50">Stok : {{ $item->stock->jumlah ?? "0" }}</h6>
                                    </div>
                                    <form action="/detail-item" method="get" class="mb-2">
                                        <input type="hidden" name="id" value="{{ $item->getId() }}">
                                        <button type="submit" class="btn btn-outline-secondary w-100">Beli</button>
                                    </form>
                                    <!-- <p class="card-text">This is a longer card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p> -->
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">

                    <div class="col">
                        <div class="card h-100">
                            <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="140"
                                preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6"
                                    dy=".3em">Image cap</text>
                            </svg>
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>

            @endif


        </div>

    </div>
    <!-- end of barang jualan -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
</body>

</html>