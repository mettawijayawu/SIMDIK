<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage; // Wajib di-import

class Formulir extends Model
{
    use HasFactory;

    protected $table = 'formulir';

    // KOREKSI KRITIS: Tentukan PK baru dan tipe datanya
    protected $primaryKey = 'no_form';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'user_id', 
        'upload_by_users',
        'upload_by_email',
        'no_form', // Primary Key harus di fillable jika dibuat secara manual
        
        'status_id', 
        'tingkat_id', 
        'jenis_kelamin_id', 
        'tahun_masuk_id', // BARU: Tambahkan kolom foreign key ini
        
        'nama_pd', 
        'tlahir', 
        'tgllahir', 
        'alamat',
        
        'namaortu', 
        'notelportu', 
        'namawali', 
        'notelpwali',
        
        'fotoanak', 
        'fotokkk',
        'status_form',
        'note',
    ];

    // ====================================================================
    // RELASI BELONGS TO (Foreign Keys di tabel Formulir)
    // ====================================================================

    /**
     * Relasi ke tabel status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * Relasi ke tabel tingkat.
     */
    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat_id');
    }
    
    /**
     * Relasi ke tabel jenis_kelamin.
     */
    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    /**
     * Relasi ke tabel tahun_masuk.
     * INI ADALAH RELASI YANG HILANG DAN MENYEBABKAN ERROR 'tahunMasuk'.
     */
    public function tahunMasuk()
    {
        return $this->belongsTo(TahunMasuk::class, 'tahun_masuk_id');
    }

    /**
     * Relasi ke tabel user (pemilik formulir).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // ====================================================================
    // RELASI HAS ONE/MANY (Formulir adalah Parent)
    // ====================================================================

    /**
     * Relasi ke tabel peserta_didik (siswa yang sudah di-konversi).
     */
    public function pesertaDidik()
    {
        // KOREKSI: Gunakan kunci asing dan kunci lokal yang benar
        // Asumsi: Kunci asing di tabel peserta_didik adalah 'formulir_id'
        // dan merujuk ke 'no_form' di sini.
        // Jika Anda menggunakan 'formulir_no_form', pastikan kolom tersebut ada di tabel peserta_didik.
        return $this->hasOne(PesertaDidik::class, 'formulir_no_form', 'no_form'); 
    }

    // ====================================================================
    // ACCESSOR / MUTATOR
    // ====================================================================

    // Asumsi: Anda ingin menggunakan accessor ini di Model Formulir
    public function getFotoUrlAttribute()
    {
        // Prioritas 1: Ambil dari kolom 'fotoanak' di Formulir
        $path = $this->fotoanak; 
        
        // Cek apakah ada relasi pesertaDidik (siswa aktif) yang memiliki foto yang berbeda
        if (!$path && $this->relationLoaded('pesertaDidik') && $this->pesertaDidik && $this->pesertaDidik->fotoanak) {
            $path = $this->pesertaDidik->fotoanak;
        }

        if ($path) {
             // Pastikan 'gcs' adalah nama disk yang benar di filesystems.php
             return Storage::disk('gcs')->url($path);
        }
        
        // Fallback yang aman (Placeholder universal)
        return 'https://placehold.co/40x40/9ca3af/ffffff?text=NP'; 
    }
}
