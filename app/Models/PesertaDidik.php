<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; 

class PesertaDidik extends Model
{
    use HasFactory;

    protected $table = 'peserta_didik';
    // Tambahkan 'tingkat_id' ke $fillable agar dapat diisi saat update/create
    protected $fillable = [
        'formulir_no_form', 'nisn', 'nis', 'tahun_masuk_id', 'tingkat_id', 'fotoanak',
    ];

    // ==========================================================
    // RELATIONS
    // ==========================================================

    /**
     * Relasi ke model Formulir (One-to-One atau Many-to-One).
     */
    public function formulir()
    {
        // Menggunakan foreign key lokal 'formulir_no_form' dan primary key rujukan 'no_form'
        return $this->belongsTo(Formulir::class, 'formulir_no_form', 'no_form');
    }
    
    /**
     * Relasi ke model TahunMasuk (Many-to-One).
     */
    public function tahunMasuk()
    {
        return $this->belongsTo(TahunMasuk::class, 'tahun_masuk_id');
    }
    
    /**
     * Relasi ke model Tingkat (Many-to-One)
     * Ini adalah metode yang hilang dan menyebabkan error.
     */
    public function tingkat()
    {
        // Asumsi foreign key di tabel 'peserta_didik' adalah 'tingkat_id'
        // Jika nama kolomnya berbeda, ganti 'tingkat_id' sesuai nama kolom Anda.
        return $this->belongsTo(Tingkat::class, 'tingkat_id');
    }

    // ==========================================================
    // ACCESSORS
    // ==========================================================

    /**
     * Accessor untuk mendapatkan URL penuh foto dari GCS.
     */
    public function getFotoUrlAttribute()
    {
        // Prioritas 1: Ambil dari kolom 'fotoanak' di PesertaDidik
        $path = $this->fotoanak; 
        
        // Prioritas 2: Jika kosong, coba ambil dari Formulir (pastikan relasinya 'formulir')
        // *CATATAN: Di sini Anda menggunakan 'formulirRelasi' yang mungkin salah.
        // Saya asumsikan nama relasi yang benar adalah 'formulir'.
        if (!$path && $this->relationLoaded('formulir')) {
            $path = $this->formulir->fotoanak ?? null;
        }

        if ($path) {
             // Pastikan 'gcs' adalah nama disk yang benar di filesystems.php
             return Storage::disk('gcs')->url($path);
        }
        
        // Fallback yang aman
        return 'https://placehold.co/40x40/9ca3af/ffffff?text=NP'; 
    }
}