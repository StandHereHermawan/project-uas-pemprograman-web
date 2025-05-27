<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <title>{{$title ?? "Home Page"}}</title>
    <style>
        .bs-max-card-height-20rem {
            max-height: 20rem;
        }
    </style>
</head>

<body>
    <header class="py-3 mb-4 border-bottom shadow sticky-top bg-body">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="#"
                class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart4"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg> <span class="ms-2 fs-3">{{ $shopName ?? "Lapo Marpaigon" }}</span>
            </a>
            <div class="col-12 col-lg-auto">
                <form action="{{ url()->to('payment-status') }}" method="get" class="d-flex justify-content-center mb-3 mb-lg-0 me-3">
                    <button class="btn btn-outline-dark" type="submit" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
    
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-bag-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="col-12 col-lg-auto">
                <form action="{{ url()->to('account') }}" method="get"
                    class="d-flex justify-content-center mb-3 mb-lg-0 me-3">
                    <button class="btn btn-outline-dark" type="submit" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </button>
                </form>
            </div>
            <!-- <form class="col-12 col-lg-auto" role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" disabled>
            </form> -->
        </div>
    </header>

    <div class="container">
        <div class="col">


            @if (isset($barang) && is_iterable($barang))

                <div>{{ $barang->onEachSide(3)->links() }}</div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">


                    @foreach ($barang as $item)

                        <div class="col">

                            <div class="card h-100">
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
                                            {{ "Rp." . $item->getHarga() }}
                                        </h5>
                                    </div>
                                    <form action="/detail-item" method="get" class="mb-2">
                                        <input type="hidden" name="id" value="{{ $item->getId() }}">
                                        <button type="submit" class="btn btn-outline-secondary w-100">Beli</button>
                                    </form>
                                    <p class="card-text">This is a longer card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
</body>

</html>