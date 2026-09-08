<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;

    // KOREKSI KRITIS: Memberi tahu Model untuk menggunakan nama tabel singular
    protected $table = 'jenis_kelamin';

    protected $fillable = ['jk']; // Sesuaikan dengan kolom Anda

    public $timestamps = true; // Atau false, sesuai kebutuhan

    // Anda mungkin perlu menambahkan relasi di sini jika diperlukan
}