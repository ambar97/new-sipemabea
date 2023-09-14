<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SahabatBc;

class SahabatBcController extends Controller
{
    public function index()
    {
        $peserta = SahabatBc::all();
        return view('welcome', ['peserta' => $peserta]);
    }
}
