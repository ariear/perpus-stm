<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(){
        return response()->json([
            'data' => Peminjaman::latest()->get(),
            'terkarbn' => Carbon::now()->format('Y-m-d')
        ], 200);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'namabuku' => 'required',
            'haripinjam' => 'required',
            'harikembali' => 'required'
        ]);

        $kelas = Kelas::where('id', $request->kelas)->first('kelas');
        $nik = Siswa::where('nama', $request->nama)->first('nik');

        Peminjaman::create([
            'nama' => $request->nama,
            'nik' => $nik->nik,
            'kelas' => $kelas->kelas,
            'namabuku' => $request->namabuku,
            'haripinjam' => $request->haripinjam,
            'harikembali' => $request->harikembali
        ]);

        return response()->json([
            'status' => 'Berhasil'
        ], 200);
    }

    public function update(Request $request){
        $peminjam = Peminjaman::latest()->get();
        foreach ($peminjam as $pinjam) {
            if ($pinjam->harikembali < Carbon::now()->format('Y-m-d')) {
                $updatetelat = Peminjaman::where('id', $pinjam->id)->first();
                $updatetelat->update([
                    'status' => 'Telat'
                ]);
            }
        }

        return response()->json([
            'pinjam' => 'anjai'
        ], 200);
    }

    public function kembalikan($id){
        $pinjam = Peminjaman::where('id', $id);
        $pinjam->delete();
        return response()->json([
            'data' => $id
        ], 200);
    }
}
