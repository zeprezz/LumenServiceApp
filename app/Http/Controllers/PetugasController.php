<?php

namespace App\Http\Controllers;

use App\Models\Petugas;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::orderBy('id', 'DESC')->paginate(10);

        return response()->json($petugas, 200);
    }
}