<?php

namespace App\Http\Controllers\Pertemuan_11;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan_11\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::select()->get();
        return view('mahasiswa.index')
            ->with("title", "Mahasiswa")
            ->with("data", $mahasiswa)
            ->with("header1", "Lorem Ipsum");
    }
}
