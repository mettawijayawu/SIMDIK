<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunMasuk extends Model
{
    // Tambahkan baris ini untuk menunjuk ke tabel 'tahun_masuk'
    protected $table = 'tahun_masuk'; 

    protected $fillable = [
        'thnmasuk',
    ];
}