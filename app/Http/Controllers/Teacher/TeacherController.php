<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulir;
use App\Models\PesertaDidik;
use App\Models\JenisKelamin;
use App\Models\Tingkat;
use App\Models\TahunMasuk;
use App\Models\Status;
use App\Models\GelombangPpdb;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Carbon\Carbon; // Pastikan Carbon di-import

class TeacherController extends Controller
{
    // ==========================================================
    // 1. DASHBOARD & STATISTIK 📊
    // ==========================================================
    public function dashboard()
    {
        // Data statistik yang akan dilempar ke view dashboard
        // Ini adalah data awal, yang akan ditimpa oleh data JSON Fetch API
        $totalPpdb = Formulir::count();
        $totalAccepted = Formulir::where('status_id', 1)->count();
        $totalPending = Formulir::where('status_id', 2)->count();
        $totalRejected = Formulir::where('status_id', 3)->count();
        $totalStudents = PesertaDidik::count();

        return view('teacher.dashboard', [
            'totalStudents' => $totalStudents,
            'totalPpdb' => $totalPpdb,
            'totalAccepted' => $totalAccepted,
            'totalPending' => $totalPending,
            'totalRejected' => $totalRejected,
        ]);
    }

public function getStatsJson()
{
    try {
        // 1. STATISTIK PPDB
        $totalPpdb = Formulir::count();
        $totalAccepted = Formulir::where('status_id', 1)->count();
        $totalPending = Formulir::where('status_id', 2)->count();
        $totalRejected = Formulir::where('status_id', 3)->count();

        // 2. STATISTIK PESERTA DIDIK (TOTAL)
        $totalStudents = PesertaDidik::count();
        
        // ==========================================================
        // !!! QUERY DATA PESERTA DIDIK (DIKOREKSI) !!!
        // ==========================================================
        
        // 3. STATISTIK PESERTA DIDIK PER TAHUN MASUK (Untuk Bar Chart)
        $studentsPerYear = PesertaDidik::join('tahun_masuk', 'peserta_didik.tahun_masuk_id', '=', 'tahun_masuk.id')
            ->select(DB::raw('tahun_masuk.thnmasuk as label'), DB::raw('count(peserta_didik.id) as count')) // Gunakan count(id) untuk kepastian
            ->groupBy('tahun_masuk.thnmasuk')
            ->orderBy('tahun_masuk.thnmasuk', 'asc')
            ->get()
            // Konversi Collection ke array asosiatif (misal: ['2023' => 50])
            ->mapWithKeys(function ($item) {
                return [$item['label'] => $item['count']];
            })
            ->all(); 
        
        // 4. STATISTIK PESERTA DIDIK PER JENIS KELAMIN (Untuk Doughnut Chart)
        $studentsPerGender = PesertaDidik::join('formulir', 'peserta_didik.formulir_no_form', '=', 'formulir.no_form')
            ->join('jenis_kelamin', 'formulir.jenis_kelamin_id', '=', 'jenis_kelamin.id')
            ->select(DB::raw('jenis_kelamin.jk as label'), DB::raw('count(peserta_didik.id) as count'))
            ->groupBy('jenis_kelamin.jk')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['label'] => $item['count']];
            })
            ->all();

        // 5. STATISTIK PESERTA DIDIK PER TINGKAT (Untuk Doughnut Chart)
        $studentsPerTingkat = PesertaDidik::join('tingkat', 'peserta_didik.tingkat_id', '=', 'tingkat.id')
            ->select(DB::raw('tingkat.tingkat as label'), DB::raw('count(peserta_didik.id) as count'))
            ->groupBy('tingkat.tingkat')
            ->orderBy('tingkat.id', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['label'] => $item['count']];
            })
            ->all();
        
        return response()->json([
            'totalPpdb' => $totalPpdb,
            'totalAccepted' => $totalAccepted,
            'totalPending' => $totalPending,
            'totalRejected' => $totalRejected,
            'totalStudents' => $totalStudents,
            
            'studentsPerYear' => $studentsPerYear,
            'studentsPerGender' => $studentsPerGender,
            'studentsPerTingkat' => $studentsPerTingkat,
        ], 200);

    } catch (\Exception $e) {
        // ... (Error handling tetap sama)
        Log::error('Gagal mengambil data statistik JSON (DB Error): ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return response()->json([
            'error' => 'Gagal memuat data dari database. Cek log server. Detail: ' . $e->getMessage(),
            'totalPpdb' => 0,
            'totalAccepted' => 0,
            'totalPending' => 0,
            'totalRejected' => 0,
            'totalStudents' => 0,
            'studentsPerYear' => [],
            'studentsPerGender' => [],
            'studentsPerTingkat' => [],
        ], 500);
    }
}

    // ==========================================================
    // 2. DATA PESERTA DIDIK (Fungsi-fungsi tetap sama)
    // ==========================================================
    
    public function dataPesertaDidik(Request $request)
    {
        // Ambil data lookup untuk dropdown filter
        $tingkatList = Tingkat::all();
        $tahunMasukList = TahunMasuk::all();

        // Eager loading relasi yang diperlukan untuk tampilan: formulir, tahunMasuk, dan tingkat
        $query = PesertaDidik::with('formulir', 'tahunMasuk', 'tingkat');

        // 1. FILTER SEARCH (NIS/NISN/NAMA SISWA)
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                // Filter berdasarkan NIS atau NISN di tabel peserta_didik
                $q->where('nis', 'like', $searchTerm)
                    ->orWhere('nisn', 'like', $searchTerm);
            })
                // Filter berdasarkan Nama Siswa di tabel formulir
                ->orWhereHas('formulir', function ($q) use ($searchTerm) {
                    $q->where('nama_pd', 'like', $searchTerm);
                });
        }

        // 2. FILTER TINGKAT
        if ($request->filled('tingkat_filter')) {
            $tingkatId = $request->tingkat_filter;
            // Filter di tabel peserta_didik karena sekarang ada kolom tingkat_id di sana
            $query->where('tingkat_id', $tingkatId);
        }

        // 3. FILTER TAHUN MASUK
        if ($request->filled('tahun_masuk_filter')) {
            $query->where('tahun_masuk_id', $request->tahun_masuk_filter);
        }

        // Ambil hasil query
        $pesertaDidik = $query->get();

        return view('teacher.data-peserta-didik', [
            'pesertaDidik' => $pesertaDidik,
            'tingkatList' => $tingkatList,
            'tahunMasukList' => $tahunMasukList,
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data peserta didik.
     */
    public function editPesertaDidik(PesertaDidik $pesertaDidik)
    {
        // Eager load data formulir, tingkat, dan tahun masuk terkait
        $pesertaDidik->load('formulir', 'tahunMasuk', 'tingkat');

        // Ambil data referensi untuk dropdown
        $jenisKelamin = JenisKelamin::all();
        $tingkat = Tingkat::all();
        $tahunMasuk = TahunMasuk::all();

        return view('teacher.edit-peserta-didik', [
            'formulir' => $pesertaDidik->formulir, // Data Formulir (untuk data read-only)
            'siswa' => $pesertaDidik, // Data PesertaDidik (sumber utama untuk field yang diedit)
            'jenisKelamin' => $jenisKelamin,
            'tingkat' => $tingkat,
            'tahunMasuk' => $tahunMasuk,
        ]);
    }

    /**
     * Menyimpan pembaruan data peserta didik.
     */
    public function updatePesertaDidik(Request $request, PesertaDidik $pesertaDidik)
    {
        // 1. Validasi Data
        $validated = $request->validate([
            // Fields yang di-update di tabel peserta_didik:
            'nis' => 'nullable|string|max:20|unique:peserta_didik,nis,' . $pesertaDidik->id,
            'nisn' => 'nullable|string|max:20',
            'tingkat_id' => 'required|exists:tingkat,id',
            'tahun_masuk_id' => 'required|exists:tahun_masuk,id',

            // Fields dari Formulir (dikirim melalui hidden input):
            'nama_pd' => 'required|string|max:150',
            'jenis_kelamin_id' => 'required|exists:jenis_kelamin,id',
            'tlahir' => 'required|string|max:100',
            'tgllahir' => 'required|date',
            'alamat' => 'required|string',
            'namaortu' => 'nullable|string|max:150',
            'notelportu' => 'nullable|string|max:20',
            'namawali' => 'nullable|string|max:150',
            'notelpwali' => 'nullable|string|max:20',
            'fotoanak' => 'nullable|string|max:255',
        ]);

        // 2. Update tabel PesertaDidik
        $pesertaDidik->update([
            'nis' => $validated['nis'],
            'nisn' => $validated['nisn'],
            'tingkat_id' => $validated['tingkat_id'],
            'tahun_masuk_id' => $validated['tahun_masuk_id'],
        ]);

        // 3. Update tabel Formulir (memastikan data read-only yang dikirim ulang tetap tersimpan)
        $formulir = $pesertaDidik->formulir;
        if ($formulir) {
            $formulir->update([
                'nama_pd' => $validated['nama_pd'],
                'jenis_kelamin_id' => $validated['jenis_kelamin_id'],
                'tlahir' => $validated['tlahir'],
                'tgllahir' => $validated['tgllahir'],
                'alamat' => $validated['alamat'],
                'namaortu' => $validated['namaortu'] ?? null,
                'notelportu' => $validated['notelportu'] ?? null,
                'namawali' => $validated['namawali'] ?? null,
                'notelpwali' => $validated['notelpwali'] ?? null,
            ]);
        }

        // Redirect ke halaman edit dengan notifikasi SweetAlert
        return redirect()->route('teacher.data-peserta-didik.edit', $pesertaDidik->id)->with('update_success', 'Data peserta didik berhasil diperbarui.')->with('success', 'Data peserta didik berhasil diperbarui.');
    }

    /**
     * Menghapus Peserta Didik dari daftar aktif.
     */
    public function destroyPesertaDidik(PesertaDidik $pesertaDidik)
    {
        $pesertaDidik->delete();
        return redirect()->route('teacher.data-peserta-didik')->with('success', 'Data peserta didik berhasil dihapus dari daftar aktif.');
    }

    /**
     * Metode baru untuk mencetak Laporan Peserta Didik ke PDF (DomPDF).
     */
    public function cetakPdfPesertaDidik(Request $request)
    {
        // Logika query sama seperti dataPesertaDidik()
        $query = PesertaDidik::with('formulir', 'tahunMasuk', 'tingkat');

        // 1. FILTER SEARCH (NIS/NISN/NAMA SISWA)
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nis', 'like', $searchTerm)
                    ->orWhere('nisn', 'like', $searchTerm);
            })
                ->orWhereHas('formulir', function ($q) use ($searchTerm) {
                    $q->where('nama_pd', 'like', $searchTerm);
                });
        }

        // 2. FILTER TINGKAT
        if ($request->filled('tingkat_filter')) {
            $tingkatId = $request->tingkat_filter;
            $query->where('tingkat_id', $tingkatId);
        }

        // 3. FILTER TAHUN MASUK
        if ($request->filled('tahun_masuk_filter')) {
            $query->where('tahun_masuk_id', $request->tahun_masuk_filter);
        }

        $pesertaDidik = $query->get();

        // Cek data untuk ditampilkan di judul PDF
        $filterTitle = 'Semua Data';
        if ($request->filled('tingkat_filter')) {
            $tingkat = Tingkat::find($request->tingkat_filter)->tingkat ?? 'Tidak Dikenal';
            $filterTitle = 'Tingkat ' . $tingkat;
        } elseif ($request->filled('tahun_masuk_filter')) {
            $tahun = TahunMasuk::find($request->tahun_masuk_filter)->thnmasuk ?? 'Tidak Dikenal';
            $filterTitle = 'Tahun Masuk ' . $tahun;
        } elseif ($request->filled('search')) {
            $filterTitle = 'Pencarian: ' . $request->search;
        }

        // Render data ke View khusus PDF
        $pdf = Pdf::loadView('teacher.laporan.peserta_didik_pdf', compact('pesertaDidik', 'filterTitle'));

        // Download file
        $fileName = 'Laporan_Peserta_Didik_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    // ==========================================================
    // 3. DATA PPDB (FORMULIR) (Fungsi-fungsi tetap sama)
    // ==========================================================

    /**
     * Menampilkan semua data PPDB (Formulir) dengan filter Tingkat & Status.
     */
    public function dataPPDB(Request $request)
    {
        // Ambil data lookup untuk dropdown filter
        $tingkatList = Tingkat::all();
        $statusList = Status::all(); // Mengambil daftar status (Diterima, Menunggu, Ditolak)
        $tahunMasukList = TahunMasuk::all();

        $query = Formulir::with('tingkat', 'status', 'tahunMasuk'); // Tambahkan tahunMasuk jika relasi ada

        // 1. FILTER TINGKAT
        if ($request->filled('tingkat_filter')) {
            $query->where('tingkat_id', $request->tingkat_filter);
        }

        // 2. FILTER STATUS
        if ($request->filled('status_filter')) {
            $query->where('status_id', $request->status_filter);
        }

        // 3. SORTING (Opsional: Urutkan berdasarkan tanggal terbaru)
        $formulirPpdb = $query->orderBy('created_at', 'desc')->get();

        return view('teacher.data-ppdb', [
            'formulirPpdb' => $formulirPpdb,
            'tingkatList' => $tingkatList,
            'statusList' => $statusList,
            'tahunMasukList' => $tahunMasukList,
        ]);
    }

    /**
     * MENAMPILKAN FORMULIR PPDB UNTUK DIEDIT/DILIHAT DETAILNYA.
     */
    public function editForm(Formulir $formulir)
    {
        // Cek jika tidak ada user login ATAU user yang login bukan pemilik DAN bukan teacher.
        if (Auth::guest() || (Auth::id() !== $formulir->user_id && !Auth::user()->isTeacher())) {
            // Jika formulir dikunci oleh admin dan yang mengakses bukan admin, tolak.
            if ($formulir->status_form === 'locked') {
                abort(403, 'Akses ditolak. Formulir ini telah dikunci oleh admin.');
            }
        }

        // Eager load data relasi yang diperlukan
        $formulir->load('tingkat', 'status', 'jenisKelamin', 'tahunMasuk');

        // Ambil data referensi untuk dropdown status
        $statusList = Status::all();
        $tingkats = Tingkat::all();
        $tahunMasukList = TahunMasuk::orderBy('thnmasuk', 'desc')->get();
        $jenisKelamin = JenisKelamin::all();

        // Mengirim objek formulir, data lookup, dan view
        return view('teacher.edit-ppdb', compact('formulir', 'tingkats', 'jenisKelamin', 'statusList', 'tahunMasukList'));
    }

    /**
     * MEMPERBARUI STATUS PPDB DAN MEMBUAT/MENGHAPUS DATA PESERTA DIDIK.
     */
    public function updateForm(Request $request, Formulir $formulir)
    {
        // 1. Otorisasi: Pemilik Formulir ATAU Admin
        if (Auth::guest() || (Auth::id() !== $formulir->user_id && !Auth::user()->isTeacher())) {
            // Jika formulir dikunci oleh admin dan yang mengakses bukan admin, tolak.
            if ($formulir->status_form === 'locked' && !Auth::user()->isTeacher()) {
                abort(403, 'Akses ditolak. Formulir ini telah dikunci oleh admin.');
            }
        }

        // 2. VALIDASI DATA
        try {
            $validatedData = $request->validate([
                // Form Formulir Fields
                'nama_pd' => ['required', 'string', 'max:150'],
                'tlahir' => ['required', 'string', 'max:100'],
                'tgllahir' => ['required', 'date'],
                'jk' => ['required', 'exists:jenis_kelamin,id'], // jenis_kelamin_id
                'tingkat' => ['required', 'exists:tingkat,id'], // tingkat_id
                'alamat' => ['required', 'string'],
                'namaortu' => ['required', 'string', 'max:150'],
                'notelportu' => ['required', 'string', 'max:20'],
                'namawali' => ['nullable', 'string', 'max:150'],
                'notelpwali' => ['nullable', 'string', 'max:20'],
                'fotoanak' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
                'fotokkk' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],

                // STATUS & PESERTA DIDIK Fields (PENTING)
                'status_id' => 'required|exists:status,id',
                'status_form' => ['required', Rule::in(['locked', 'unlocked'])], // <-- BARU: Status Lock/Unlock
                'note' => ['nullable', 'string', 'max:500'], // <-- BARU: Catatan Admin
                'nis_pd' => ['nullable', 'string', 'max:20'],
                'nisn_pd' => ['nullable', 'string', 'max:20'],
                'tahun_masuk_id' => [
            $request->status_id == 1 ? 'required' : 'nullable',
            'exists:tahun_masuk,id'
                ],
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('VALIDATION FAILED in TeacherController@updateForm: ' . json_encode($e->errors()));
            return redirect()->back()->withInput()->withErrors($e->errors())->with('failure', 'Terdapat kesalahan pada input Anda. Silakan periksa kembali.');
        }

        $disk = 'gcs'; // Sesuaikan disk storage Anda
        $folder = 'documents/formulir/' . $formulir->no_form;
        $newStatusId = (int)$validatedData['status_id'];

        $siswa = PesertaDidik::where('formulir_no_form', $formulir->no_form)->first();

        try {
            DB::beginTransaction();

            // 3. Kelola File Upload
            $fotoAnakPath = $formulir->fotoanak;
            if ($request->hasFile('fotoanak')) {
                if ($formulir->fotoanak) {
                    Storage::disk($disk)->delete($formulir->fotoanak);
                }
                $fotoAnakPath = $request->file('fotoanak')->store($folder, $disk);
            }

            $fotoKKPath = $formulir->fotokkk;
            if ($request->hasFile('fotokkk')) {
                if ($formulir->fotokkk) {
                    Storage::disk($disk)->delete($formulir->fotokkk);
                }
                $fotoKKPath = $request->file('fotokkk')->store($folder, $disk);
            }

            // 4. Update Data di Model Formulir
            $formulir->update([
                'tingkat_id' => $validatedData['tingkat'],
                'jenis_kelamin_id' => $validatedData['jk'],
                'nama_pd' => $validatedData['nama_pd'],
                'tlahir' => $validatedData['tlahir'],
                'tgllahir' => $validatedData['tgllahir'],
                'alamat' => $validatedData['alamat'],
                'namaortu' => $validatedData['namaortu'],
                'notelportu' => $validatedData['notelportu'],
                'namawali' => $validatedData['namawali'],
                'notelpwali' => $validatedData['notelpwali'],
                'fotoanak' => $fotoAnakPath,
                'fotokkk' => $fotoKKPath,
                'status_id' => $newStatusId,
                'status_form' => $validatedData['status_form'], // <-- UPDATE STATUS FORM
                'note' => $validatedData['note'] ?? null, // <-- UPDATE CATATAN
            ]);

            // 5. LOGIKA SINKRONISASI PESERTA DIDIK

            if ($newStatusId === 1) { // KASUS DITERIMA

    // Ambil tahun_masuk_id dari form, jika kosong (failsafe) ambil yang terbaru
    $tahunMasukId = $validatedData['tahun_masuk_id'] ?? $formulir->tahun_masuk_id ?? TahunMasuk::orderBy('thnmasuk', 'desc')->first()->id;

    if (!$siswa) {
        // Buat data baru
        PesertaDidik::create([
            'formulir_no_form' => $formulir->no_form,
            'nis' => $validatedData['nis_pd'] ?? null,
            'nisn' => $validatedData['nisn_pd'] ?? null,
            'tingkat_id' => $validatedData['tingkat'], // Pastikan tingkat sesuai pilihan terakhir di form
            'tahun_masuk_id' => $tahunMasukId,
            'fotoanak' => $fotoAnakPath,
        ]);
        $message = 'Status berhasil diubah menjadi **Diterima**. Data peserta didik baru telah dibuat.';
    } else {
        // Update data siswa yang sudah ada
        $siswa->update([
            'nis' => $validatedData['nis_pd'] ?? $siswa->nis,
            'nisn' => $validatedData['nisn_pd'] ?? $siswa->nisn,
            'tingkat_id' => $validatedData['tingkat'],
            'tahun_masuk_id' => $tahunMasukId,
            'fotoanak' => $fotoAnakPath,
        ]);
        $message = 'Status berhasil diubah menjadi **Diterima**. Data peserta didik telah diperbarui.';
    }
}
            DB::commit();

            // 6. Redirect
            return redirect()->route('teacher.data-ppdb', $formulir->no_form)->with('update_success', $message);

        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            Log::critical('Update Formulir GAGAL: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->back()->with('failure', 'Pembaruan gagal total: ' . $e->getMessage());
        }
    }


    // Fungsi updateStatus yang tampaknya sudah digantikan oleh updateForm
    public function updateStatus(Request $request, Formulir $formulir)
    {
        return $this->updateForm($request, $formulir);
    }

    public function syncPesertaDidik(PesertaDidik $pesertaDidik)
    {
        // 1. Dapatkan data formulir terkait
        $formulir = Formulir::where('no_form', $pesertaDidik->formulir_no_form)->first();

        if (!$formulir) {
            return back()->with('failure', 'Gagal sinkronisasi: Data formulir terkait tidak ditemukan.');
        }

        try {
            // 2. Data yang disinkronkan ke tabel 'formulir'
            $dataToUpdateFormulir = [
                'nama_pd' => $formulir->nama_pd,
                'jenis_kelamin_id' => $formulir->jenis_kelamin_id,
                'tlahir' => $formulir->tlahir,
                'tgllahir' => $formulir->tgllahir,
                'alamat' => $formulir->alamat,
                'namaortu' => $formulir->namaortu,
                'notelportu' => $formulir->notelportu,
                'namawali' => $formulir->namawali,
                'notelpwali' => $formulir->notelpwali,
            ];
            $formulir->update($dataToUpdateFormulir);


            // 3. Data yang disinkronkan ke tabel 'peserta_didik'
            $dataToUpdateSiswa = [];

            if (is_null($pesertaDidik->fotoanak) && !is_null($formulir->fotoanak)) {
                $dataToUpdateSiswa['fotoanak'] = $formulir->fotoanak;
            }

            // TAHUN MASUK (Jika kosong)
            if (is_null($pesertaDidik->tahun_masuk_id)) {
                $formulirYear = $formulir->created_at->format('Y');
                $tahunMasuk = TahunMasuk::where('thnmasuk', $formulirYear)->first();
                $dataToUpdateSiswa['tahun_masuk_id'] = $tahunMasuk->id ?? TahunMasuk::latest()->first()->id ?? 1;
            }

            // TINGKAT (Jika kosong)
            if (is_null($pesertaDidik->tingkat_id) && !is_null($formulir->tingkat_id)) {
                $dataToUpdateSiswa['tingkat_id'] = $formulir->tingkat_id;
            }


            if (!empty($dataToUpdateSiswa)) {
                $pesertaDidik->update($dataToUpdateSiswa);
            }

        } catch (\Exception $e) {
            return back()->with('failure', 'Gagal sinkronisasi: ' . $e->getMessage());
        }

        return back()->with('success', 'Data berhasil disinkronkan dari Formulir: ' . ($formulir->no_form ?? $formulir->id));
    }

    public function cetakPdfPPDB(Request $request)
{
    // Ambil data dari model Formulir (bukan PesertaDidik)
    $query = Formulir::with(['tingkat', 'status', 'tahunMasuk']);

    // 1. FILTER TINGKAT
    if ($request->filled('tingkat_filter')) {
        $query->where('tingkat_id', $request->tingkat_filter);
    }

    // 2. FILTER STATUS
    if ($request->filled('status_filter')) {
        $query->where('status_id', $request->status_filter);
    }

    // 3. PENCARIAN NAMA
    if ($request->filled('search')) {
        $searchTerm = '%' . $request->search . '%';
        $query->where('nama_pd', 'like', $searchTerm);
    }

    // Ambil hasil query dengan variabel $ppdb agar sesuai dengan Blade
    $ppdb = $query->orderBy('no_form', 'asc')->get();

    // Logika Judul Filter
    $filterTitle = 'Semua Data';
    if ($request->filled('tingkat_filter')) {
        $tingkat = Tingkat::find($request->tingkat_filter)->tingkat ?? 'Tidak Dikenal';
        $filterTitle = 'Tingkat ' . $tingkat;
    }
    if ($request->filled('status_filter')) {
        $status = Status::find($request->status_filter)->status ?? 'Tidak Dikenal';
        $filterTitle .= ($filterTitle == 'Semua Data' ? '' : ' - ') . 'Status ' . $status;
    }

    // Render ke View
    $pdf = Pdf::loadView('teacher.laporan.ppdb_pdf', compact('ppdb', 'filterTitle'));

    // Download file
    $fileName = 'Laporan_PPDB_' . date('Ymd_His') . '.pdf';
    return $pdf->download($fileName);
}

    // ==========================================================
    // 4. PENGATURAN INFORMASI (Gelombang & Foto)
    // ==========================================================

    /**
     * Menampilkan halaman pengaturan Informasi (Gelombang dan Foto).
     */
    public function informasi()
    {
        // [MODIFIKASI] Panggil fungsi update otomatis
        GelombangPpdb::autoUpdateStatus(); 

        // Ambil semua data gelombang
        $gelombangs = GelombangPpdb::orderBy('tgl_buka', 'desc')->get();

        // Ambil path foto homepage
        $fotoHomepage = Pengaturan::where('key', 'foto_homepage')->first();

        return view('teacher.informasi', [
            'gelombangs' => $gelombangs,
            'fotoHomepage' => $fotoHomepage ? $fotoHomepage->value : null,
        ]);
    }

    // --- CRUD GELOMBANG ---

    /**
     * Menyimpan Gelombang Baru.
     */
    public function storeGelombang(Request $request)
    {
        $validated = $request->validate([
            'nama_gelombang' => 'required|string|max:100',
            'tgl_buka' => 'required|date',
            'tgl_tutup' => 'required|date|after_or_equal:tgl_buka',
        ]);

        GelombangPpdb::create($validated);
        
        // Panggil status update otomatis setelah membuat data baru
        GelombangPpdb::autoUpdateStatus(); 

        return redirect()->route('teacher.informasi')->with('success', 'Gelombang baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui Gelombang.
     */
    public function updateGelombang(Request $request, GelombangPpdb $gelombang)
    {
        $validated = $request->validate([
            'nama_gelombang' => 'required|string|max:100',
            'tgl_buka' => 'required|date',
            'tgl_tutup' => 'required|date|after_or_equal:tgl_buka',
            // Pastikan 'is_active' tidak divalidasi
        ]);

        $gelombang->update($validated);
        
        // Panggil status update otomatis setelah menyimpan tanggal baru
        GelombangPpdb::autoUpdateStatus(); 
        
        return redirect()->route('teacher.informasi')->with('success', 'Gelombang berhasil diperbarui dan status aktif telah diperbarui otomatis.');
    }

    /**
     * Menghapus Gelombang.
     */
    public function destroyGelombang(GelombangPpdb $gelombang)
    {
        $gelombang->delete();
        GelombangPpdb::autoUpdateStatus(); // Refresh status setelah penghapusan
        return redirect()->route('teacher.informasi')->with('success', 'Gelombang berhasil dihapus.');
    }

    // --- PENGATURAN FOTO HOMEPAGE ---

    /**
     * Upload dan update Foto Homepage.
     */
    public function updateFotoHomepage(Request $request)
    {
        $request->validate([
            'foto_homepage' => 'required|image|mimes:jpg,jpeg,png|max:4096', // Max 4MB
        ]);

        $disk = 'gcs'; // Ganti ke disk storage Anda
        $folder = 'settings/homepage';
        $fotoKey = 'foto_homepage';

        // 1. Ambil pengaturan lama
        $pengaturan = Pengaturan::where('key', $fotoKey)->first();
        $oldPath = $pengaturan->value ?? null;

        try {
            // 2. Upload file baru
            $path = $request->file('foto_homepage')->store($folder, $disk);

            // 3. Hapus file lama jika ada
            if ($oldPath && $oldPath !== $path) {
                Storage::disk($disk)->delete($oldPath);
            }

            // 4. Simpan path baru ke database
            Pengaturan::updateOrCreate(
                ['key' => $fotoKey],
                ['value' => $path]
            );

            return redirect()->route('teacher.informasi')->with('success', 'Foto Halaman Utama berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Update Foto Homepage GAGAL: ' . $e->getMessage());
            return redirect()->back()->with('failure', 'Gagal mengupload foto: ' . $e->getMessage());
        }
    }

    public function contact()
    {
        return view('teacher.contact');
    }

    public function welcome()
    {
        // Panggil auto update untuk memastikan status aktif di halaman depan selalu benar
        GelombangPpdb::autoUpdateStatus(); 
        
        // 1. Ambil Gelombang Aktif
        $activeGelombang = \App\Models\GelombangPpdb::active()->first();

        // 2. Ambil URL Foto Homepage
        $fotoHomepage = \App\Models\Pengaturan::where('key', 'foto_homepage')->first();
        $disk = 'gcs'; // <-- SESUAIKAN DENGAN DISK STORAGE ANDA

        $fotoHomepageUrl = asset('img/smm.jpg'); // Fallback default image path
        if ($fotoHomepage && $fotoHomepage->value) {
            try {
                $fotoHomepageUrl = \Illuminate\Support\Facades\Storage::disk($disk)->url($fotoHomepage->value);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Gagal mendapatkan URL foto_homepage di welcome: " . $e->getMessage());
            }
        }

        return view('welcome', [
            'activeGelombang' => $activeGelombang,
            'fotoHomepageUrl' => $fotoHomepageUrl,
        ]);
    }
}