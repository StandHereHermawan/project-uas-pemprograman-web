<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    protected $table = "uas_stok_barangs";
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
        'id_barang_jualan',
        'jumlah'
    ];

    public function getId()
    {
        if ($this->id !== null) {
            return $this->id;
        } else {
            return null;
        }
    }

    public function getIdBarangJualan()
    {
        if ($this->id_barang_jualan !== null) {
            return $this->id_barang_jualan;
        } else {
            return null;
        }
    }

    public function getStokBarang()
    {
        if ($this->jumlah !== null) {
            return $this->jumlah;
        } else {
            return null;
        }
    }
}
