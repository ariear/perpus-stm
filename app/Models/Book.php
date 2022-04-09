<?php

namespace App\Models;

use App\Models\BookType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function booktype(){
        return $this->belongsTo(BookType::class);
    }
}
