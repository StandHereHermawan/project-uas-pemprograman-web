<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{$title ?? "Status Pembayaran"}}</title>
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

        .transaction-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
            overflow: hidden;
        }

        .status-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #664d03;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #842029;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .logo-text {
            font-family: 'Arial Rounded MT Bold', 'Arial', sans-serif;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .price-value {
            font-weight: 600;
            color: var(--secondary-color);
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
                <h1 class="mb-0 fs-4 fw-bold logo-text">{{ $shopName ?? "Lapo Marpaigon" }}</h1>
            </div>
        </div>
    </header>
    <!-- End of Header Navigation -->

    <!-- Main Content -->
    <main class="container my-5">
        <div class="transaction-card p-4 mb-4">
            <h2 class="text-center mb-4">
                <i class="bi bi-receipt me-2"></i>Status Pembayaran
            </h2>


            @if (isset($transaction))
                <div class="mb-3">
                    {{ $transaction->onEachSide(3)->links() }}
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No. Transaksi</th>
                                <th scope="col" class="text-center">Barang</th>
                                <th scope="col" class="text-center">Pembeli</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Total Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $transactionPerItem)
                                <tr>
                                    <td class="text-center">{{ $transactionPerItem->id }}</td>
                                    <td class="text-center">
                                        {{ $transactionPerItem->barangDibeli->nama_barang ?? "Nama Barang" }}
                                        <div class="small text-muted">ID: {{ $transactionPerItem->id_barang_jualan }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $transactionPerItem->barangDibeli->seller->name }}
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $buyersName ?? "Nama Pembeli" }}</td>
                                    <td class="text-center">{{ $transactionPerItem->jumlah_pembelian }}</td>
                                    <td class="text-center">
                                        @if ($transactionPerItem->status === 'dibatalkan')
                                            <span class="badge status-cancelled rounded-pill p-2">
                                                <i class="bi bi-x-circle me-1"></i> Dibatalkan
                                            </span>
                                        @elseif ($transactionPerItem->status === 'success')
                                            <span class="badge status-success rounded-pill p-2">
                                                <i class="bi bi-check-circle me-1"></i> Sukses
                                            </span>
                                        @else
                                            <span class="badge status-pending rounded-pill p-2">
                                                <i class="bi bi-hourglass-split me-1"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center price-value">
                                        Rp{{ number_format($transactionPerItem->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($transactionPerItem->status === 'pending')
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="{{ url()->to('payment') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="id-transaksi-penjualan" value="{{ $transactionPerItem->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-credit-card me-1"></i> Bayar
                                                    </button>
                                                </form>
                                                <form action="{{ url()->to('cancel-payment') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id-transaksi-penjualan" value="{{ $transactionPerItem->id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-x-circle me-1"></i> Batal
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted small">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bi bi-receipt-cutoff display-4 text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada transaksi</h4>
                    <p class="text-muted">Belum ada riwayat transaksi yang tersedia</p>
                </div>
            @endif
        </div>
    </main>
    <!-- End of Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
