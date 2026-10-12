<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::orderBy('id', 'DESC')->paginate(10);

        return response()->json($pengembalian, 200);
    }
}