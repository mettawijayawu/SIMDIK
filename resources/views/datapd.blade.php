<x-app-layout>
    <style>

        @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
        }
        
    </style>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-slot name="header">
        <div style="margin-bottom: 40px;">
            {{-- Header slot --}}
        </div>
    </x-slot>

    {{-- TENTUKAN APAKAH FORM HARUS DIKUNCI (DISAMAKAN UNTUK SEMUA USER): --}}
    @php
        $isLocked = ($formulir->status_form == 'locked');
        $disabledAttribute = $isLocked ? 'disabled' : '';
    @endphp

    <section class="form-ppdb-container">
        <div class="form-header">
            <h1>Edit Formulir Pendaftaran Peserta Didik Baru </br>
                ({{ $formulir->no_form }})</h1>
            
            @if ($isLocked)
                <p class="text-red-700 font-semibold" style="margin-top: 10px;">
                    Formulir ini telah dikunci oleh panitia dan tidak dapat diubah.
                </p>
            @else
                <p>Perbarui data anak Anda di bawah ini. Dokumen dan perubahan akan diverifikasi ulang.</p>
            @endif

            {{-- Tampilan Catatan Admin (noted) --}}
            @if (!empty($formulir->noted))
                <div class="mt-4 p-3 bg-yellow-100 border border-yellow-300 rounded-lg">
                    <p class="font-semibold text-yellow-800">Catatan Panitia:</p>
                    <p class="text-yellow-700 whitespace-pre-line">{{ $formulir->noted }}</p>
                </div>
            @endif
        </div>

        {{-- AREA UNTUK MENAMPILKAN PESAN SUKSES/GAGAL (DIBIARKAN SAMA) --}}
        @if (session('success'))
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; border-radius: .25rem; color: #155724; background-color: #d4edda;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <p style="font-weight: bold; margin-top: 0;">Pembaruan gagal karena kesalahan berikut:</p>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('failure'))
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                {{ session('failure') }}
            </div>
        @endif

        {{-- FORM MENGGUNAKAN METHOD PATCH --}}
        <form method="POST" action="{{ route('formulir.update', $formulir->no_form) }}" enctype="multipart/form-data"
            class="ppdb-form">
            @csrf
            @method('PATCH')

            {{-- BAGIAN 1: Data Pribadi Calon Siswa --}}
            <fieldset class="form-section">
                <legend>1. Data Pribadi Calon Siswa (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        {{-- **DISABLED** --}}
                        <input type="text" id="nama_pd" name="nama_pd"
                            value="{{ old('nama_pd', $formulir->nama_pd) }}" required {{ $disabledAttribute }}>
                        @error('nama_pd')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        {{-- **DISABLED** --}}
                        <input type="text" id="tlahir" name="tlahir"
                            value="{{ old('tlahir', $formulir->tlahir) }}" required {{ $disabledAttribute }}>
                        @error('tlahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        {{-- **DISABLED** --}}
                        <input type="date" id="tgllahir" name="tgllahir"
                            value="{{ old('tgllahir', $formulir->tgllahir) }}" required {{ $disabledAttribute }}>
                        @error('tgllahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="jk">Jenis Kelamin</label>
                        {{-- **DISABLED** --}}
                        <select id="jk" name="jk" required {{ $disabledAttribute }}>
                            <option value="">Pilih Jenis Kelamin</option>
                            @isset($jenisKelamin)
                                @foreach ($jenisKelamin as $jkItem)
                                    <option value="{{ $jkItem->id }}"
                                        {{ old('jk', $formulir->jenis_kelamin_id) == $jkItem->id ? 'selected' : '' }}>
                                        {{ $jkItem->jk }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('jk')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field full-width">
                        <label for="alamat">Alamat Lengkap</label>
                        {{-- **DISABLED** --}}
                        <input type="text" id="alamat" name="alamat"
                            value="{{ old('alamat', $formulir->alamat) }}" required {{ $disabledAttribute }}>
                        @error('alamat')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="tingkat">Tingkat Pendaftaran</label>
                        {{-- **DISABLED** --}}
                        <select id="tingkat" name="tingkat" required {{ $disabledAttribute }}>
                            <option value="">Pilih Tingkat</option>
                            @isset($tingkats)
                                @foreach ($tingkats as $tingkatItem)
                                    <option value="{{ $tingkatItem->id }}"
                                        {{ old('tingkat', $formulir->tingkat_id) == $tingkatItem->id ? 'selected' : '' }}>
                                        {{ $tingkatItem->tingkat }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('tingkat')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 3: Data Orang Tua & Kontak --}}
            <fieldset class="form-section">
                <legend>2. Data Orang Tua & Kontak (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        {{-- **DISABLED** --}}
                        <input type="text" id="namaortu" name="namaortu"
                            value="{{ old('namaortu', $formulir->namaortu) }}" required {{ $disabledAttribute }}>
                        @error('namaortu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        {{-- **DISABLED** --}}
                        <input type="tel" id="notelportu" name="notelportu"
                            value="{{ old('notelportu', $formulir->notelportu) }}" required {{ $disabledAttribute }}>
                        @error('notelportu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        {{-- **DISABLED** --}}
                        <input type="text" id="namawali" name="namawali"
                            value="{{ old('namawali', $formulir->namawali) }}" {{ $disabledAttribute }}>
                        @error('namawali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        {{-- **DISABLED** --}}
                        <input type="tel" id="notelpwali" name="notelpwali"
                            value="{{ old('notelpwali', $formulir->notelpwali) }}" {{ $disabledAttribute }}>
                        @error('notelpwali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 4: Upload Dokumen Pendukung --}}
            <fieldset class="form-section">
                <legend>3. Upload Dokumen Pendukung</legend>
                <p class="warning-text">Format yang diterima: JPG, PNG, atau PDF. Ukuran maksimal 2MB per file.
                    Kosongkan jika tidak ada perubahan.</p>

                <div class="form-group-grid two-columns">

                    <div class="form-field">
                        <label for="fotoanak">Pas Foto Anak Terbaru (3x4)</label>
                        {{-- **DISABLED** --}}
                        <input type="file" id="fotoanak" name="fotoanak" accept=".jpg, .png, .pdf" {{ $disabledAttribute }}>
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            @if ($formulir->fotoanak)
                                <a href="{{ Storage::disk('gcs')->url($formulir->fotoanak) }}" target="_blank"
                                    class="text-blue-600 hover:underline">Lihat File</a>
                            @else
                                Belum ada file.
                            @endif
                        </p>
                        <img id="preview_fotoanak" src="" alt="Pratinjau Foto Anak"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                        @error('fotoanak')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="fotokkk">Kartu Keluarga (KK) Asli</label>
                        {{-- **DISABLED** --}}
                        <input type="file" id="fotokkk" name="fotokkk" accept=".jpg, .png, .pdf" {{ $disabledAttribute }}>
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            @if ($formulir->fotokkk)
                                <a href="{{ Storage::disk('gcs')->url($formulir->fotokkk) }}" target="_blank"
                                    class="text-blue-600 hover:underline">Lihat File</a>
                            @else
                                Belum ada file.
                            @endif
                        </p>
                        <img id="preview_fotokk" src="" alt="Pratinjau Foto KK"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                        @error('fotokkk')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Script preview (DIBIARKAN SAMA) --}}
                <script>
                    function setupImagePreview(inputId, imgId) {
                        const input = document.getElementById(inputId);
                        const img = document.getElementById(imgId);
                        if (!input || !img) return;

                        input.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            } else {
                                img.style.display = 'none';
                                img.src = '';
                            }
                        });
                    }
                    document.addEventListener('DOMContentLoaded', () => {
                        setupImagePreview('fotoanak', 'preview_fotoanak');
                        setupImagePreview('fotokkk', 'preview_fotokk');

                        // LOGIC MENAMPILKAN GAMBAR LAMA SAAT LOAD
                        const fotoAnakUrl = "{{ $formulir->fotoanak ? Storage::disk('gcs')->url($formulir->fotoanak) : '' }}";
                        const fotoKKUrl = "{{ $formulir->fotokkk ? Storage::disk('gcs')->url($formulir->fotokkk) : '' }}";

                        // Menampilkan foto anak jika URL ada dan bukan PDF
                        if (fotoAnakUrl && (fotoAnakUrl.endsWith('.jpg') || fotoAnakUrl.endsWith('.png') || fotoAnakUrl
                                .endsWith('.jpeg'))) {
                            document.getElementById('preview_fotoanak').src = fotoAnakUrl;
                            document.getElementById('preview_fotoanak').style.display = 'block';
                        }

                        // Menampilkan foto KK jika URL ada dan bukan PDF
                        if (fotoKKUrl && (fotoKKUrl.endsWith('.jpg') || fotoKKUrl.endsWith('.png') || fotoKKUrl.endsWith(
                                '.jpeg'))) {
                            document.getElementById('preview_fotokk').src = fotoKKUrl;
                            document.getElementById('preview_fotokk').style.display = 'block';
                        }
                    });
                </script>
            </fieldset>

            {{-- Status ID dan status_form dikirim sebagai hidden input agar tidak hilang saat POST --}}
            <input type="hidden" name="status_id" value="{{ $formulir->status_id }}">
            <input type="hidden" name="status_form" value="{{ $formulir->status_form }}">
            <input type="hidden" name="noted" value="{{ $formulir->noted }}">

            <div class="form-actions">
                {{-- Tombol Batal selalu tampil --}}
                <a href="{{ route('dashboard') }}" class="back-button" style="margin-right: 10px;">Batal</a>
                
                {{-- Tombol Simpan HANYA tampil jika TIDAK terkunci --}}
                @if (!$isLocked)
                    <button type="submit"
                        class="submit-button bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan
                        Pembaruan</button>
                @endif
            </div>
        </form>
    </section>

    {{-- SCRIPT POP-UP NOTIFIKASI SUKSES --}}
    @if (session('update_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update data Berhasil!',
                text: 'Data formulir No. {{ $formulir->no_form }} telah berhasil diperbarui.',

                // KOREKSI KRITIS: Menggunakan 'top' untuk memusatkan di bagian atas.
                position: 'top',

                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                // Pastikan tidak ada properti 'toast: true' jika Anda ingin pop-up yang besar
                // Jika Anda ingin tampilan seperti toast (kecil), tambahkan 'toast: true' di sini.

                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    @endif

</x-app-layout>