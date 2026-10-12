<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with([
            'buku',
            'anggota',
            'petugas'
        ])->orderBy('id', 'DESC')->paginate(10);

        return response()->json($peminjaman, 200);
    }
}