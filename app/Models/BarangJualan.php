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
        'user_id',
        'nama_barang',
        'harga'
    ];

    public function getId()
    {
        if ($this->id !== null) {
            return $this->id;
        } else {
            return null;
        }
    }

    public function getNamaBarang()
    {
        if ($this->nama_barang !== null) {
            return $this->nama_barang;
        } else {
            return null;
        }
    }

    public function getHarga()
    {
        if ($this->harga !== null) {
            return $this->harga;
        } else {
            return null;
        }
    }

    public function stock()
    {
        return $this->hasOne(StokBarang::class, 'id_barang_jualan', 'id');
    }

    public function seller()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
