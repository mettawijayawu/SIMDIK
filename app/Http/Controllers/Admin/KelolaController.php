<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunMasuk; 
use App\Models\Tingkat; 
use Illuminate\Http\Request;

class KelolaController extends Controller
{
    /**
     * Tampilkan data Tahun dan Tingkat. (READ)
     */
    public function index()
    {
        // Mengambil data Tahun Masuk
        $data_tahun = TahunMasuk::orderBy('thnmasuk', 'desc')->get();
        // Mengambil data Tingkat
        $data_tingkat = Tingkat::orderBy('tingkat', 'asc')->get();
        
        // Mengirimkan kedua set data ke view admin.kelola
        return view('admin.kelola', compact('data_tahun', 'data_tingkat'));
    }

    // --- Fungsi CRUD untuk TAHUN MASUK ---

    public function storeTahun(Request $request) 
    {
        $request->validate(['thnmasuk' => 'required|string|unique:tahun_masuk,thnmasuk']);

        TahunMasuk::create(['thnmasuk' => $request->thnmasuk]);

        return redirect()->route('admin.kelola')->with('success', 'Tahun Masuk berhasil ditambahkan.');
    }

    public function destroyTahun($id) 
    {
        TahunMasuk::findOrFail($id)->delete();
        return redirect()->route('admin.kelola')->with('success', 'Tahun Masuk berhasil dihapus.');
    }

    // --- Fungsi CRUD untuk TINGKAT ---

    public function storeTingkat(Request $request) 
    {
        $request->validate(['tingkat' => 'required|string|unique:tingkat,tingkat']);

        Tingkat::create(['tingkat' => $request->tingkat]);

        return redirect()->route('admin.kelola')->with('success', 'Tingkat berhasil ditambahkan.');
    }

    public function destroyTingkat($id) 
    {
        Tingkat::findOrFail($id)->delete();
        return redirect()->route('admin.kelola')->with('success', 'Tingkat berhasil dihapus.');
    }
}