<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <title>{{$title ?? "Status Pembayaran"}}</title>
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
                    <button type="submit" class="btn btn-outline-dark w-100">Home</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-10 offset-lg-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Id Transaction</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Nama Penjual</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Barang</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Nama Pembeli</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Jumlah Pembelian</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Status</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Total Harga</div>
                            </th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Opsi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($transaction))

                            <div>{{ $transaction->onEachSide(3)->links() }}</div>

                            @foreach ($transaction as $transactionPerItem)
                                <tr>
                                    <th scope="col">
                                        <div class="d-flex justify-content-center">
                                            {{ $transactionPerItem->id }}
                                        </div>
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $transactionPerItem->barangDibeli->seller->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{$transactionPerItem->barangDibeli->nama_barang ?? "Nama Barang" }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $buyersName ?? "Nama Pembeli" }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $transactionPerItem->jumlah_pembelian }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if ($transactionPerItem->status === 'dibatalkan')
                                                <button disabled="disabled" class="btn btn-outline-danger">
                                                    {{ $transactionPerItem->status }}
                                                </button>

                                            @elseif ($transactionPerItem->status === 'success')
                                                <button disabled="disabled" class="btn btn-success">
                                                    {{ $transactionPerItem->status }}
                                                </button>
                                            @else
                                                <button disabled="disabled" class="btn btn-warning">
                                                    {{ $transactionPerItem->status }}
                                                </button>
                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ "Rp" . $transactionPerItem->total_harga }}
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @if ($transactionPerItem->status === 'pending')
                                            <form action="{{ url()->to('payment') }}" method="get" class="mb-2 mb-lg-0 me-1">
                                                @csrf
                                                <input type="hidden" name="id-transaksi-penjualan"
                                                    value="{{ $transactionPerItem->id }}">
                                                <button type="submit" class="btn btn-outline-dark mb-2 mb-lg-0"
                                                    id="pay-button">Bayar</button>
                                            </form>

                                            <form action="{{ url()->to('cancel-payment') }}" method="post" class="mb-2 mb-lg-0">
                                                @csrf
                                                <input type="hidden" name="id-transaksi-penjualan"
                                                    value="{{ $transactionPerItem->id }}">
                                                <button type="submit" class="btn btn-outline-dark opacity-50">Batal</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-outline-dark opacity-50"
                                                placeholder="tidak bisa diklik" disabled>Tidak Ada</button>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
</body>

</html>