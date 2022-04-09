<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DataCountController extends Controller
{
    public function index(){
        return response()->json([
            'buku' => Book::all(),
            'jenisbuku' => BookType::all(),
            'peminjam' => Peminjaman::all(),
            'telat' => Peminjaman::where('status', 'Telat')->get()
        ], 200);
    }
}
