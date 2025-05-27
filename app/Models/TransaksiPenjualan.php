<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $table = "uas_transaksi_penjualans";
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
        'user_id',
        'id_barang_jualan',
        'jumlah_pembelian',
        'status',
        'total_harga'
    ];

    public function barangDibeli()
    {
        return $this->hasOne(BarangJualan::class, 'id', 'id_barang_jualan');
    }
}
