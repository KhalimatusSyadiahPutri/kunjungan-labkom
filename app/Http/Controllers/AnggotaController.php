<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function create()
    {
        return view('anggota.create'); // Sesuaikan dengan lokasi view form anggota
    }

}
