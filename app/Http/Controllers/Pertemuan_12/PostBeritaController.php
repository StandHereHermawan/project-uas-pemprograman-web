<?php

namespace App\Http\Controllers\Pertemuan_12;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostBeritaController extends Controller
{
    public function formPostMahasiswa() {
        return view('mahasiswa.form');
    }
}
