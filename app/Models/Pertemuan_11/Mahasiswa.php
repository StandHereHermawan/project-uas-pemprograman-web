<?php

namespace App\Models\Pertemuan_11;

use App\Models\Pertemuan_12\Postberita;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\HasFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "judul",
        "isi",
        "penulis",
        "layak_publish"
    ];

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'mahasiswas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function postBerita()
    {
        return $this->hasMany(Postberita::class);
    }
}
