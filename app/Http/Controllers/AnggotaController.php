<?php

namespace App\Http\Controllers;

use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::orderBy('id', 'DESC')->paginate(10);

        return response()->json($anggota, 200);
    }
}