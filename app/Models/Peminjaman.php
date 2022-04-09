<?php

namespace App\Models;

use App\Enums\PeminjamanStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'status' => PeminjamanStatus::class
    ];
}
