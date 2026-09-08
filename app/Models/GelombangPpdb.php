<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GelombangPpdb extends Model
{
    use HasFactory;

    protected $table = 'gelombang_ppdb';
    protected $fillable = [
        'nama_gelombang',
        'tgl_buka',
        'tgl_tutup',
        'is_active',
    ];

    protected $casts = [
        'tgl_buka' => 'date',
        'tgl_tutup' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk mengambil gelombang yang sedang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * [FIXED FOR AUTO TRANSITION] Logika untuk otomatis mengaktifkan/menonaktifkan gelombang.
     * Logika: 
     * 1. Nonaktifkan semua.
     * 2. Cari satu-satunya gelombang yang sedang berjalan (tgl_buka <= Hari Ini <= tgl_tutup).
     * 3. Aktifkan gelombang tersebut.
     */
    public static function autoUpdateStatus()
    {
        // Ambil tanggal hari ini dalam format Y-m-d
        $today = Carbon::today()->format('Y-m-d');
        
        try {
            DB::beginTransaction();

            // 1. NONAKTIFKAN SEMUA GELOMBANG DULU (Langkah Reset)
            self::query()->update(['is_active' => false]);
            
            // 2. TENTUKAN GELOMBANG YANG SEHARUSNYA AKTIF HARI INI
            // Diurutkan dari yang paling awal dibuka (asc) untuk memastikan Gelombang 1 diaktifkan duluan 
            // jika ada overlapping tanggal.
            $nextActiveGelombang = self::whereRaw('tgl_buka <= ?', [$today])
                                   ->whereRaw('tgl_tutup >= ?', [$today])
                                   ->orderBy('tgl_buka', 'asc') 
                                   ->first();
            
            if ($nextActiveGelombang) {
                // 3. AKTIFKAN HANYA SATU GELOMBANG TERPILIH
                $nextActiveGelombang->update(['is_active' => true]);
                // Log::info("Gelombang otomatis diaktifkan: " . $nextActiveGelombang->nama_gelombang);
            } else {
                 // Log::info("Tidak ada gelombang yang aktif saat ini. Semua gelombang ditutup.");
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal Auto Update Status Gelombang: ' . $e->getMessage()); 
            return false;
        }
    }
}