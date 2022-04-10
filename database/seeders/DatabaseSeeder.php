<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookType;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kelas' => 'X-RPL'
        ]);
        Kelas::create([
            'kelas' => 'X-TAB'
        ]);
        Kelas::create([
            'kelas' => 'X-TKJ'
        ]);
        Kelas::create([
            'kelas' => 'X-TKR'
        ]);
        Kelas::create([
            'kelas' => 'X-TBSM'
        ]);
        Kelas::create([
            'kelas' => 'X-TITL'
        ]);
        Kelas::create([
            'kelas' => 'X-BKP'
        ]);

        User::create([
            'name' => 'Arie Akbarull Ridho',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
