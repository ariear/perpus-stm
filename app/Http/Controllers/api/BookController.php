<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Book::with('booktype')->latest()->get()
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
            'title' => 'required|unique:books',
            'keterangan' => 'required',
            'booktype_id' => 'required',
            'stock' => 'required|integer'
        ]);

        $book = Book::create([
            'title' => $request->title,
            'keterangan' => $request->keterangan ,
            'booktype_id' => $request->booktype_id,
            'stock' => $request->stock
        ]);

        return response()->json([
            'keterangan' => 'Buku berhasil ditambahkan',
            'data' => $book
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json([
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'keterangan' => 'required',
            'booktype_id' => 'required',
            'stock' => 'required|integer'
        ]);

        if ($request->title != $book->title) {
            $request->validate([
                'title' => 'required|unique:books'
            ]);
        }

        $book->update([
            'title' => $request->title,
            'keterangan' => $request->keterangan,
            'booktype_id' => $request->booktype_id,
            'stock' => $request->stock
        ]);

        return response()->json([
            'data' => $request->title,
            'book' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = $book->delete();

        return response()->json([
            'keterangan' => 'Buku berhasil dihapus',
            'data' => '$book'
        ], 200);
    }
}
