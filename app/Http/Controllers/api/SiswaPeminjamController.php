<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaPeminjamController extends Controller
{
    public function index(Kelas $kelas){
        return response()->json([
            'data' => $kelas
        ], 200);
    }
}
