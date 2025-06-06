<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangJualan extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = "uas_barang_jualans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'seller_id',
        'nama_barang',
        'harga'
    ];

    public function getId()
    {
        return $this->id;
    }

    public function getNamaBarang()
    {
        return $this->nama_barang;
    }

    public function getHarga()
    {
        return $this->harga;
    }

    public function stock()
    {
        return $this->hasOne(StokBarang::class, 'id_barang_jualan', 'id');
    }

    public function seller()
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    public function sells()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'id_barang_jualan', 'id');
    }

    public function peopleWhoBuy()
    {
        return $this->hasManyThrough(
            User::class,
            TransaksiPenjualan::class,
            'buyer_id',
            'id',
            'seller_id',
            'id',
        );
    }
}
