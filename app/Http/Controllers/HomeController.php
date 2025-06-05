<?php

namespace App\Http\Controllers;

use App\Models\BarangJualan;
use App\Models\StokBarang;
use App\Models\TransaksiPenjualan;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Uid\UuidV4;

class HomeController extends Controller
{
    public function homePage(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');
        $barang = BarangJualan::select()->with('stock')->paginate(8);
        $userModel = User::select()->where('email','=',$email)->first();
        return response(
            view("toko.home")
                ->with("barang", $barang)
                ->with('userRole', $userModel->hasRole()->first()->role)
        );
    }

    public function paymentStatus(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');

        /**
         * @var \App\Models\User
         */
        $userModel = User::where('email', '=', $email)->first();
        Log::debug('HomeController.paymentStatus', ["userId" => $userModel]);

        /**
         * @var \App\Models\TransaksiPenjualan
         */
        $transaksiPenjualanModel = TransaksiPenjualan::where('user_id', '=', $userModel->id)
            ->with('barangDibeli')
            ->paginate(6);

        return response(
            view("toko.payment-status")
                ->with('transaction', $transaksiPenjualanModel)
                ->with('buyersName', $userModel->name)
        );
    }

    public function detailItem(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');

        $userModel = User::select()->where('email', '=', $email)->first();

        $idBarang = $request->only("id")["id"];
        $itemBarang = BarangJualan::select()->where("id", "=", $idBarang)->first();
        $stokBarang = StokBarang::select()->where("id_barang_jualan", "=", $idBarang)->first();

        return response(
            view("toko.detail-item")
                ->with("namaBarang", $itemBarang->getNamaBarang())
                ->with("namaPembeli", $userModel->name)
                ->with("idPembeli", $userModel->id)
                ->with("hargaBarang", $itemBarang->getHarga())
                ->with("jumlah", $stokBarang->getStokBarang())
                ->with("idBarang", $idBarang)
        );
    }

    public function addItemForm(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');

        return view('toko.input-item');
    }

    public function submitAddItemForm(Request $request)
    {
        $orderedGoods = $request->only([
            'goods-name',
            'harga',
            'stok-barang'
        ]);

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($orderedGoods, [
            "goods-name" => ['required', 'min:4'],
            'harga' => ['required', 'numeric', 'min:1000'],
            'stok-barang' => ['required', 'numeric', 'min:1']
        ]);

        if ($validator->fails()) {
            # code...
            return back()->withErrors($validator->getMessageBag());
        }

        $acceptedInput = $validator->validated();

        DB::beginTransaction();

        $barangJualanModel = BarangJualan::create([
            "nama_barang" => $acceptedInput['goods-name'],
            "harga" => $acceptedInput['harga']
        ]);

        StokBarang::create(
            [
                "id_barang_jualan" => $barangJualanModel->getId(),
                "jumlah" => $acceptedInput['stok-barang']
            ]
        );
        DB::commit();

        return redirect()->route('home');
    }

    public function submitPesanan(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');

        $orderedGoods = $request->only([
            'goodsId',
            'quantity',
            'buyers',
            'buyers-id'
        ]);

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($orderedGoods, [
            "quantity" => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            # code...
            return back()->withErrors(["quantity" => $validator->errors()->getMessages()]);
        }

        /**
         * @var \App\Models\StokBarang
         */
        $stokBarangModel = StokBarang::where(
            'id_barang_jualan',
            '=',
            $orderedGoods['goodsId']
        )->first();

        // Cek apakah pemesanan melebihi stok yang ada.
        if ($orderedGoods['quantity'] > $stokBarangModel->jumlah) {
            return back()->withErrors(["quantity" => "Please order as the available stocks."]);
        }

        /**
         * @var \App\Models\BarangJualan
         */
        $barangJualanModel = BarangJualan::where(
            'id',
            '=',
            $orderedGoods['goodsId']
        )->first();

        /**
         * @var \App\Models\User
         */
        $userModel = User::where(
            'id',
            '=',
            $orderedGoods['buyers-id']
        )->first();

        /**
         * @var int
         * Total barang di tabel stok barang dikurangi
         */
        $jumlahAkhir = $stokBarangModel->jumlah - $orderedGoods['quantity'];

        /**
         * @var int
         * Total Harga untuk disimpan di tabel Transaksi penjualan
         */
        $totalHarga = $barangJualanModel->harga * $orderedGoods['quantity'];

        $transaksiPenjualanModel = null;
        $jumlahPembelian = $orderedGoods['quantity'];

        $transaksiPenjualanModel = DB::transaction(function () use ($userModel, $stokBarangModel, $jumlahPembelian, $totalHarga, $barangJualanModel, $jumlahAkhir) {

            /**
             * @var \App\Models\User
             */
            $transaksiPenjualanModel = TransaksiPenjualan::create([
                "user_id" => $userModel->id,
                "id_barang_jualan" => $barangJualanModel->id,
                "jumlah_pembelian" => $jumlahPembelian,
                "total_harga" => $totalHarga,
            ]);

            $stokBarangModel->update(["jumlah" => $jumlahAkhir]);

            return $transaksiPenjualanModel;
        });

        return redirect()->route('payment-status')->with('user_id', $transaksiPenjualanModel->user_id);
    }

    public function cancelPayment(Request $request)
    {
        $input = $request->only(['id-transaksi-penjualan']);

        $transaksiPenjualanModel = TransaksiPenjualan::where('id', '=', $input['id-transaksi-penjualan'])->first();
        $stokBarangModel = StokBarang::where('id_barang_jualan', '=', $transaksiPenjualanModel->id_barang_jualan)->first();

        Log::debug('HomeController.cancelPayment', ["transaksiPenjualanModel" => $transaksiPenjualanModel]);

        $jumlahPembelianBarangYangDibatalkan = $transaksiPenjualanModel->jumlah_pembelian;

        $stokBarangSaatIni = $stokBarangModel->jumlah;
        $jumlahAkhir = $stokBarangSaatIni + $jumlahPembelianBarangYangDibatalkan;

        DB::transaction(function () use ($transaksiPenjualanModel, $stokBarangModel, $jumlahAkhir) {
            $transaksiPenjualanModel->update(["status" => 'dibatalkan']);
            $stokBarangModel->update(["jumlah" => $jumlahAkhir]);
        });

        return redirect()->route('payment-status');
    }

    public function paymentSuccess(Request $request)
    {
        $input = $request->only(['id-transaksi-penjualan']);

        $transaksiPenjualanModel = TransaksiPenjualan::where('id', '=', $input['id-transaksi-penjualan'])->first();
        $stokBarangModel = StokBarang::where('id_barang_jualan', '=', $transaksiPenjualanModel->id_barang_jualan)->first();

        Log::debug('HomeController.cancelPayment', ["transaksiPenjualanModel" => $transaksiPenjualanModel]);
        $transaksiPenjualanModel->update(["status" => 'success']);

        // $stokAwal = $stokBarangModel->jumlah;
        // $jumlahPembelian = $transaksiPenjualanModel->jumlah_pembelian;
        // $stokSetelahPembelian = $stokAwal - $jumlahPembelian;

        // $stokBarangModel->update(["jumlah" => $stokSetelahPembelian]);

        return redirect()->route('payment-status');
    }

    public function paymentToMidtrans(Request $request)
    {
        $email = $request->cookie('X-LOGIN-TOKEN');
        $input = $request->only(['id-transaksi-penjualan']);

        /**
         * @var \App\Models\TransaksiPenjualan
         */
        $transaksiPenjualanModel = TransaksiPenjualan
            ::where('id', '=', $input['id-transaksi-penjualan'])
            ->first();

        /**
         * @var \App\Models\BarangJualan
         */
        $barangJualanModel = BarangJualan
            ::where('id', '=', $transaksiPenjualanModel->id_barang_jualan)
            ->first();

        /**
         * @var \App\Models\User
         */
        $userModel = User
            ::where('email', '=', $email)
            ->first();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $transactionDetails = array(
            'order_id' => $transaksiPenjualanModel->id . ". " . UuidV4::v4(),
            'gross_amount' => $transaksiPenjualanModel->total_harga
        );

        $customerDetails = array(
            'first_name' => $userModel->name,
            'email' => $userModel->email
        );

        $itemDetails = array(
            'id' => $barangJualanModel->id,
            'price' => $barangJualanModel->harga,
            'quantity' => $transaksiPenjualanModel->jumlah_pembelian,
            'name' => $barangJualanModel->nama_barang
        );

        $params = array(
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            // 'item_details' => $itemDetails
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response(view('toko.payment-item')
            ->with("idBarang", $transaksiPenjualanModel->id_barang_jualan)
            ->with("namaBarang", $barangJualanModel->nama_barang)
            ->with("idPemesanan", $transaksiPenjualanModel->id)
            ->with("totalHarga", $transaksiPenjualanModel->total_harga)
            ->with('snapToken', $snapToken));
    }
}
