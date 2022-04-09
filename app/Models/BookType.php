<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function book(){
        return $this->hasMany(Book::class);
    }
}
