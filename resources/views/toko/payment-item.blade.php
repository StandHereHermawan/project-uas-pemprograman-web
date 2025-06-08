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
                <form action="/home">
                    <button type="submit" class="btn btn-outline-dark w-100">
                        <i class="bi bi-house-door me-1"></i>Home</button>
                </form>
            </div>
        </div>
    </header>

    <content class="container-fluid">
        <div class="row">
            <div class="col-10 col-md-6 offset-md-1">
                <h5>Id Barang</h5>
                <p class="opacity-75">{{ $idBarang ?? "Belum ada" }}</p>
                <h5>Nama Barang</h5>
                <p class="opacity-75">{{ $namaBarang ?? "Belum ada" }}</p>
                <h5>Id Pemesanan</h5>
                <p class="opacity-75">{{ $idPemesanan ?? "Belum ada" }}</p>
                <h5>Total Harga</h5>
                @if (isset($totalHarga))
                    <p class="opacity-75">{{ "Rp" . $totalHarga}}</p>
                @else
                    <p class="opacity-75">{{ "Rp" . "0"}}</p>
                @endif
                <div class="d-flex">
                    <button type="submit" class="btn btn-outline-dark mb-2 mb-lg-0 me-1" id="pay-button">Bayar</button>
                    <form action="{{ url()->to('payment-status') }}" method="get">
                        <button type="submit" class="btn btn-outline-dark mb-2 mb-lg-0" id="pay-button">Kembali</button>
                    </form>
                </div>
                <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
                <script type="text/javascript">
                    document.getElementById('pay-button').onclick = function () {
                        // SnapToken acquired from previous step
                        snap.pay('<?=$snapToken?>', {
                            // Optional
                            onSuccess: function (result) {
                                /* You may add your own js here, this is just example */
                                // # document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                window.location.href = '{{ url()->route('payment-success', ['id-transaksi-penjualan' => $idPemesanan]) }}';
                            },
                            // Optional
                            onPending: function (result) {
                                /* You may add your own js here, this is just example */
                                // # document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            },
                            // Optional
                            onError: function (result) {
                                /* You may add your own js here, this is just example */
                                // # document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            }
                        });
                    };
                </script>
            </div>
        </div>
    </content>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
</body>

</html>