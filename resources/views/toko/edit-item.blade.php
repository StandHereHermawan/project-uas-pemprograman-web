<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Edit Items" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="mt-3">

        <div class="container-fluid container-md">
            <div class="col-auto col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
                <div class="border rounded-3 p-4">
                    <form id="myForm" method="post" novalidate>
                        @csrf
                        <div class="">
                            <!-- header form -->
                            <h1 class="mb-4 text-center text-secondary">{{ $header ?? "Edit Items" }}</h1>
                            <!-- end header form -->

                            <!-- id barang -->
                            <input type="hidden" name="goods-id" value="{{ $idBarang }}" id="">
                            <!-- end of id barang -->

                            <!-- barang input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="goods-name" id="goods-name-id" type="text"
                                    value="{{ old("goods-name") }}" placeholder="goods-name" autocomplete="true"
                                    required />
                                <label for="goods-name-id">Nama Barang</label>

                                <div class="d-flex w-100 justify-content-between">
                                    <div id="" class="form-text">Isi nama barang baru disini.</div>
                                    <div id="" class="form-text">Nama Barang Lama:
                                        {{ $oldGoodsData->nama_barang ?? "Belum ada nama." }}.
                                    </div>
                                </div>

                                <!-- barang error message -->
                                @if ($errors->has('goods-name'))
                                    <div class="text-danger">{{ $errors->first('goods-name') }}</div>
                                @endif
                                @if (isset($goodsNameError))
                                    <div class="text-danger">{{ $goodsNameError }}</div>
                                @endif
                                <!-- end barang error message -->
                            </div>
                            <!-- end barang input  -->



                            <!-- email input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="harga" id="harga" type="text" placeholder="harga"
                                    value="{{ old("harga") }}" autocomplete="true" required />
                                <label for="harga">Harga Barang</label>

                                <div class="d-flex w-100 justify-content-between">
                                    <div id="" class="form-text">Isi harga barang baru disini.</div>
                                    <div id="" class="form-text">Harga Lama:
                                        {{ $oldGoodsData->getHarga() ?? "Harga Lama Kosong." }}
                                    </div>
                                </div>

                                <!-- email error message -->
                                @if ($errors->has('harga'))
                                    <div class="text-danger">{{ $errors->first('harga') }}</div>
                                @endif
                                <!-- end email error message -->
                            </div>
                            <!-- end of email input  -->



                            <!-- password input  -->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="stok-barang" id="stok-barang" type="text"
                                    placeholder="stok-barang" value="{{ old("stok-barang") }}" autocomplete="true"
                                    required />
                                <label for="stok-barang">Stok Barang Tersedia</label>

                                <div class="d-flex w-100 justify-content-between">
                                    <div id="" class="form-text">Isi stok barang baru disini.</div>
                                    <div id="" class="form-text">Stok Lama: {{ $oldStock->jumlah ?? "10"}}.</div>
                                </div>

                                <!-- password error message -->
                                @if ($errors->has('stok-barang'))
                                    <div class="text-danger">{{ $errors->first('stok-barang') }}</div>
                                @endif
                                <!-- end password error message -->
                            </div>
                            <!-- end of password input  -->



                            <!-- button submit input -->
                            <div class="form-floating mb-2">
                                <button type="submit" class="btn btn-outline-danger w-100">Simpan</button>
                            </div>
                            <!-- end of button submit input -->
                        </div>
                    </form>
                    <div>
                        <a href="{{ url()->to('home') }}">
                            <button class="btn btn-outline-dark w-100">Kembali</button>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Ambil semua input dalam form
        //     let inputs = document.querySelectorAll("#myForm input, #myForm password");

        //     // Cek apakah ada data tersimpan, lalu isi kembali
        //     inputs.forEach(input => {
        //         let savedValue = localStorage.getItem(input.id);
        //         if (savedValue) {
        //             input.value = savedValue;
        //         }

        //         // Simpan value setiap kali berubah
        //         input.addEventListener("input", function () {
        //             localStorage.setItem(input.id, input.value);
        //         });
        //     });

        //     // Hapus data saat form dikirim
        //     // document.getElementById("myForm").addEventListener("submit", function () {
        //     //     localStorage.clear();
        //     // });
        // });
    </script>
</body>

</html>