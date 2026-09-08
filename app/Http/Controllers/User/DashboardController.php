<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formulir;
use App\Models\Status;
use App\Models\Tingkat;
use App\Models\GelombangPpdb; // <-- PASTIKAN INI ADA
use App\Models\Pengaturan; 
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard dengan data formulir user yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil semua formulir yang diajukan oleh user ini, beserta relasinya
        $formulirs = Formulir::with(['status', 'tingkat'])
                             ->where('user_id', $userId)
                             ->orderBy('created_at', 'desc')
                             ->get();

        // 2. Kirim data formulir ke view
        // Pastikan Anda sudah menambahkan relasi di Model Formulir.php
        return view('dashboard', compact('formulirs'));
    }
}
