<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => BookType::latest()->get()
        ], 200);
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
            'name' => 'required|unique:book_types'
        ]);

        $booktype = BookType::create([
            'name' => $request->name
        ]);

        return response()->json([
            'keterangan' => 'Jenis buku behasil ditambahkan',
            'data' => $booktype
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typebook = BookType::find($id);

        return response()->json([
            'data' => $typebook
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookType $bookType)
    {
        $jenisbuku = $bookType->find($request->id);

        $request->validate([
            'name' => 'required'
        ]);

        if ($request->name != $jenisbuku->name) {
            $request->validate([
                'name' => 'required|unique:book_types'
            ]);
        }

        $jenisbuku->update([
            'name' => $request->name
        ]);

        return response()->json([
            'response' => $request->name,
            'data' => $jenisbuku
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typebook = BookType::find($id)->delete();

        return response()->json([
            'keterangan' => 'Jenis buku berhasil di hapus',
            'data' => $typebook
        ], 200);
    }
}
