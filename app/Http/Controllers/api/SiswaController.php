<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:siswas',
            'nama' => 'required',
            'kelas_id' => 'required'
        ]);

        Siswa::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id
        ]);

        return response()->json([
            'keterangan' => 'Siswa berhasil ditambahkan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => Siswa::with('kelas')->where('kelas_id', $id)->latest()->get(),
            'kelas' => Kelas::where('id', $id)->first()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return response()->json([
            'data' => $siswa
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($request->nik != $siswa->nik) {
            $request->validate([
                'nik' => 'required|unique:siswas'
            ]);
        }

        $siswa->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id
        ]);

        return response()->json([
            'data' => $siswa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return response()->json([
            'data' => $siswa
        ], 200);
    }
}
