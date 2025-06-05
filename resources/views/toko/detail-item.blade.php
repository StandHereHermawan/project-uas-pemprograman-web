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
        <div class="container d-flex flex-wrap justify-content-between">
            <a href="#"
                class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart4"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg> <span class="ms-2 fs-3">{{ $shopName ?? "Lapo Marpaigon" }}</span>
            </a>
            <div class="col-12 col-lg-auto" role="search">
                @csrf
                <form action="/home">
                    <button type="submit" class="btn btn-outline-dark w-100">Home</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-8 col-md-5 offset-md-1">
                <div>
                    <h5>Nama Barang</h5>
                    <p class="opacity-75">{{ $namaBarang ?? "Belum ada" }}</p>
                    <h5>Harga</h5>
                    <p class="opacity-75">{{ "Rp" . $hargaBarang ?? "Rp.0" }} per Satuan</p>
                    <h5>Stok</h5>
                    <p class="opacity-75">{{ $jumlah ?? "0" }}</p>
                    <h5>Nama Penjual</h5>
                    <p class="opacity-75">{{ $namaPenjual ?? "0" }}</p>
                </div>

                <form action="{{ url()->current() }}" method="post" class="col-auto">
                    @csrf

                    <div>
                        <h5>Nama Pembeli</h5>
                        <p class="opacity-75">{{ $namaPembeli }}</p>
                        <input type="hidden" name="buyers" value="{{ $namaPembeli }}">
                        <input type="hidden" name="buyers-id" value="{{ $idPembeli }}">
                    </div>
                    <input type="hidden" name="goodsId" value="{{ $idBarang ?? "0" }}">

                    <div>
                        <h5>Hendak Membeli Sebanyak</h5>
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" name="quantity" id="floatingInput" value="1">
                            <label for="floatingInput overflow-x">Jumlah pembelian</label>
                        </div>
                        <!-- password error message -->
                        @if ($errors->has('quantity'))
                            <div class="text-danger mb-2">{{ $errors->first('quantity') }}</div>
                        @endif
                        <!-- end password error message -->

                    </div>

                    <button type="submit" class="btn btn-outline-dark mt-2">Pesan</button>

                </form>
            </div>

            <div class="col-8 col-lg-3 offset-0 offset-md-1 offset-lg-0">
                <div class="col">
                    <div class="card bs-max-card-height-20rem mt-2 mt-lg-0 w-100">
                        <svg aria-label="Placeholder: Image cap" class="bd-placeholder-img card-img-top" height="140"
                            preserveAspectRatio="xMidYMid slice" role="img" width="100%"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="41%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                        </svg>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h5 class="card-title">{{ $namaBarang ?? "Belum ada" }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
</body>

</html>