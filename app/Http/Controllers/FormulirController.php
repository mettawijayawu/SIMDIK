<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Formulir;
use App\Models\PesertaDidik;
use App\Models\Status;
use App\Models\JenisKelamin;
use App\Models\User;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Log;

class FormulirController extends Controller
{

    public function create()
    {
        $tingkats = Tingkat::all();
        $jenisKelamin = JenisKelamin::all(); 
        
        return view('formulir', compact('tingkats', 'jenisKelamin'));
    }

    /**
     * Menyimpan data formulir baru ke DB.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('login')->with('failure', 'Sesi login Anda berakhir. Silakan login kembali.');
        }

        // 1. VALIDASI DATA
        try {
            $validatedData = $request->validate([
                'nama_pd' => ['required', 'string', 'max:150'],
                'tlahir' => ['required', 'string', 'max:100'],
                'tgllahir' => ['required', 'date'],
                'jk' => ['required', 'exists:jenis_kelamin,id'],    
                'tingkat' => ['required', 'exists:tingkat,id'], 
                'alamat' => ['required', 'string'],
                'namaortu' => ['required', 'string', 'max:150'],
                'notelportu' => ['required', 'string', 'max:20'],
                'namawali' => ['nullable', 'string', 'max:150'],
                'notelpwali' => ['nullable', 'string', 'max:20'],
                'fotoanak' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
                'fotokkk' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            ]);
            Log::info('Validation successful.');

        } catch (ValidationException $e) {
            Log::error('VALIDATION FAILED: ' . json_encode($e->errors()));
            return redirect()->back()->withInput()->withErrors($e->errors())->with('failure', 'Terdapat kesalahan pada input Anda. Silakan periksa kembali.');
        }

        // === 2. LOGIKA BISNIS: Pengecekan Duplikasi dan Penentuan Nomor Formulir ===

        // 2.1 Pengecekan Duplikasi: 
        $existingForm = Formulir::where('user_id', $user->id)
                                 ->where('nama_pd', $validatedData['nama_pd'])
                                 ->where('tlahir', $validatedData['tlahir'])
                                 ->where('tgllahir', $validatedData['tgllahir'])
                                 ->where('jenis_kelamin_id', $validatedData['jk'])
                                 ->where('tingkat_id', $validatedData['tingkat'])
                                 ->first();

        if ($existingForm) {
            // Jika ditemukan formulir dengan SEMUA kriteria identitas yang sama
            $errorMsg = 'Anda sudah mendaftarkan anak dengan identitas yang persis sama. Silakan periksa formulir yang sudah ada dengan nomor: ' . $existingForm->no_form . '.';
            Log::warning('DUPLICATION ATTEMPT: ' . $errorMsg);
            
            return redirect()->back()->withInput()->withErrors([
                'nama_pd' => $errorMsg // Mengaitkan error ke field nama_pd
            ])->with('failure', 'Pendaftaran gagal karena terdeteksi duplikasi identitas anak yang sama.');
        }
        
        // 2.2 Tentukan Nomor Formulir 
        $currentYear = date('y');
        $prefix = 'F-' . $currentYear;
        $latestForm = Formulir::where('no_form', 'like', $prefix . '%')->orderBy('no_form', 'desc')->first();
        $digitLength = 5;
        $nextId = $latestForm ? (int)substr($latestForm->no_form, -5) + 1 : 1;
        $formattedId = str_pad($nextId, $digitLength, '0', STR_PAD_LEFT);
        $nextNoForm = $prefix . $formattedId;

        // 3. INISIALISASI FILE UPLOAD
        $fotoAnakPath = null;
        $fotoKKPath = null;
        $disk = 'gcs';
        $folder = 'documents/formulir/' . $nextNoForm;

        try {
            // LANGKAH 3.1: UPLOAD FILE KE GCS
            if ($request->hasFile('fotoanak')) {
                $fotoAnakPath = $request->file('fotoanak')->store($folder, $disk);
            }
            if ($request->hasFile('fotokkk')) {
                $fotoKKPath = $request->file('fotokkk')->store($folder, $disk);
            }

            // LANGKAH 4: MENGAMBIL ID STATUS Awal
            $statusAwal = Status::where('status', 'Menunggu Konfirmasi')->firstOrFail(); 

            // 5. TRANSAKSI DB DIMULAI
            DB::beginTransaction();

            // 6. SIMPAN KE TABEL FORMULIR
            $formulir = Formulir::create([
                'user_id' => $user->id,
                'no_form' => $nextNoForm,
                'status_id' => $statusAwal->id, 
                
                // Data Kriteria Identitas
                'tingkat_id' => $validatedData['tingkat'],
                'jenis_kelamin_id' => $validatedData['jk'], 
                'nama_pd' => $validatedData['nama_pd'],
                'tlahir' => $validatedData['tlahir'],
                'tgllahir' => $validatedData['tgllahir'],
                
                // Data Lainnya
                'alamat' => $validatedData['alamat'],
                'namaortu' => $validatedData['namaortu'],
                'notelportu' => $validatedData['notelportu'],
                'namawali' => $validatedData['namawali'],
                'notelpwali' => $validatedData['notelpwali'],
                
                'fotokkk' => $fotoKKPath,
                'fotoanak' => $fotoAnakPath, 

                'upload_by_users' => $user->username,
                'upload_by_email' => $user->email,
            ]);

            DB::commit();

            // 8. Redirect Sukses
            return redirect('terimakasih')->with('success', 'Pendaftaran berhasil. Nomor formulir anak Anda adalah: ' . $nextNoForm . '. Status pendaftaran Anda saat ini adalah Menunggu Konfirmasi.');

        } catch (\Exception $e) {

            // 9. ROLLBACK JIKA GAGAL
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            // ROLLBACK FILE UPLOAD
            if (isset($fotoAnakPath) && $fotoAnakPath && Storage::disk($disk)->exists($fotoAnakPath)) {
                Storage::disk($disk)->delete($fotoAnakPath);
            }
            if (isset($fotoKKPath) && $fotoKKPath && Storage::disk($disk)->exists($fotoKKPath)) {
                Storage::disk($disk)->delete($fotoKKPath);
            }

            Log::critical('Pendaftaran GAGAL TOTAL. Penyebab utama: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->back()->withInput()->withErrors([
                'gagal_server' => 'Pendaftaran gagal karena: ' . $e->getMessage() . ' (Silakan periksa log server untuk detail lebih lanjut.)'
            ])->with('failure', 'Pendaftaran gagal total. Silakan cek detail di bawah ini.');
        }
    }

    // =========================================================
    // METODE EDIT/UPDATE FORMULIR
    // =========================================================

    /**
     * Tampilkan formulir edit dengan data dari database.
     */
    public function edit(Formulir $formulir)
    {
        // 1. Otorisasi: Pastikan user yang login adalah pemilik formulir ini (TIDAK ADA PERAN TEACHER DI VIEW INI)
        if (Auth::id() !== $formulir->user_id) {
            abort(403, 'Akses ditolak. Anda bukan pemilik formulir ini.');
        }

        $tingkats = Tingkat::all();
        $jenisKelamin = JenisKelamin::all(); 
        
        // Mengirim objek formulir, data lookup, dan view yang baru (datapd)
        return view('datapd', compact('formulir', 'tingkats', 'jenisKelamin'));
    }

    /**
     * Simpan pembaruan data formulir ke DB dan kelola file GCS.
     */
    public function update(Request $request, Formulir $formulir)
    {
        // 1. Otorisasi Kepemilikan (Wajib)
        if (Auth::id() !== $formulir->user_id) {
            abort(403, 'Akses ditolak.');
        }

        // 2. LOGIKA KEAMANAN LOCK SERVER-SIDE (HANYA CEK STATUS_FORM)
        // KARENA INI ADALAH CONTROLLER USER BIASA, KITA TOLAK MUTLAK JIKA LOCKED.
        if ($formulir->status_form === 'locked') {
            Log::warning('UPDATE DITOLAK: Formulir ' . $formulir->no_form . ' dikunci. User biasa mencoba update.');
            // Jika user mencoba update formulir yang dikunci, tolak dan kirim pesan error
            return redirect()->route('formulir.edit', $formulir->no_form)->with('failure', 'Pembaruan dibatalkan. Formulir ini telah dikunci oleh panitia.');
        }
        
        // 3. VALIDASI DATA
        try {
            // Validasi sama seperti store, tapi file tidak wajib di-upload saat update jika sudah ada
            $validatedData = $request->validate([
                'nama_pd' => ['required', 'string', 'max:150'],
                'tlahir' => ['required', 'string', 'max:100'],
                'tgllahir' => ['required', 'date'],
                'jk' => ['required', 'exists:jenis_kelamin,id'],    
                'tingkat' => ['required', 'exists:tingkat,id'], 
                'alamat' => ['required', 'string'],
                'namaortu' => ['required', 'string', 'max:150'],
                'notelportu' => ['required', 'string', 'max:20'],
                'namawali' => ['nullable', 'string', 'max:150'],
                'notelpwali' => ['nullable', 'string', 'max:20'],
                // File tidak wajib di-upload saat update, tapi harus disiapkan untuk validasi jika diisi
                'fotoanak' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
                'fotokkk' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            ]);

        } catch (ValidationException $e) {
            Log::error('VALIDATION FAILED during update: ' . json_encode($e->errors()));
            return redirect()->back()->withInput()->withErrors($e->errors())->with('failure', 'Terdapat kesalahan pada input Anda. Silakan periksa kembali.');
        }

        $disk = 'gcs';
        $folder = 'documents/formulir/' . $formulir->no_form; 

        try {
            DB::beginTransaction();

            // 4. Kelola File Upload (Ganti/Upload Baru)
            $fotoAnakPath = $formulir->fotoanak;
            if ($request->hasFile('fotoanak')) {
                // HAPUS file lama dari GCS (Jika ada)
                if ($formulir->fotoanak) {
                    Storage::disk($disk)->delete($formulir->fotoanak);
                }
                $fotoAnakPath = $request->file('fotoanak')->store($folder, $disk);
            }
            
            $fotoKKPath = $formulir->fotokkk;
            if ($request->hasFile('fotokkk')) {
                // HAPUS file lama dari GCS (Jika ada)
                if ($formulir->fotokkk) {
                    Storage::disk($disk)->delete($formulir->fotokkk);
                }
                $fotoKKPath = $request->file('fotokkk')->store($folder, $disk);
            }

            // 5. Update Data di Model
            $formulir->update([
                // Data FK
                'tingkat_id' => $validatedData['tingkat'],  
                'jenis_kelamin_id' => $validatedData['jk'],  
                
                // Data Pribadi
                'nama_pd' => $validatedData['nama_pd'],
                'tlahir' => $validatedData['tlahir'],
                'tgllahir' => $validatedData['tgllahir'],
                'alamat' => $validatedData['alamat'],

                // Data Orang Tua
                'namaortu' => $validatedData['namaortu'],
                'notelportu' => $validatedData['notelportu'],
                'namawali' => $validatedData['namawali'],
                'notelpwali' => $validatedData['notelpwali'],
                
                // Path Dokumen
                'fotoanak' => $fotoAnakPath, 
                'fotokkk' => $fotoKKPath,    
            ]);

            DB::commit();

            // 6. Redirect ke halaman edit yang sama
            return redirect()->route('formulir.edit', $formulir->no_form)->with('update_success', 'Update data Berhasil!');

        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            
            Log::critical('Update Formulir GAGAL: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            
            return redirect()->back()->with('failure', 'Pembaruan gagal total: ' . $e->getMessage());
        }
    }
}