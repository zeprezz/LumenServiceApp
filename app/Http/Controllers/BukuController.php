<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::orderBy('id', 'DESC')->paginate(10);

        return response()->json($buku, 200);
    }

    public function tersedia()
    {
        $buku = Buku::where('stok', '>', 0)
                    ->orderBy('judul', 'ASC')
                    ->get();

        return response()->json($buku, 200);
    }

    public function jumlah()
    {
        $total = Buku::count();

        return response()->json([
            'total_buku' => $total
        ], 200);
    }

    public function tambahStok($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->increment('stok');

        return response()->json([
            'message' => 'Stok berhasil ditambah',
            'buku' => $buku->fresh()
        ], 200);
    }
}