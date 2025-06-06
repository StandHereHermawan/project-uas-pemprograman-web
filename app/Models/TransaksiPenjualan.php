<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    const TABLE_NAME = "uas_transaksi_penjualans";

    protected $table = TransaksiPenjualan::TABLE_NAME;
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'id_barang_jualan',
        'jumlah_pembelian',
        'status',
        'total_harga'
    ];

    public function barangDibeli()
    {
        return $this->hasOne(
            BarangJualan::class,
            'id',
            'id_barang_jualan'
        );
    }

    public function buyer()
    {
        return $this->hasOne(
            User::class,
            'id',
            'buyer_id'
        );
    }

    public function seller()
    {
        return $this->hasOne(
            User::class,
            'id',
            'seller_id'
        );
    }
}
