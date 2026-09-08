<x-app-layout>
    <style>
        /* ======================================= */
        /* CSS GLOBAL FIX: Memastikan Font Poppins Tetap Terpakai */
        /* ======================================= */
        body {
            /* Pastikan font Poppins tetap ada */
            font-family: 'Poppins', sans-serif;
        }

        /* ======================================= */
        /* CSS DEFAULT (Desktop) & Base Layout */
        /* ======================================= */
        
        /* HEADER BASE */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 5%;
            background-color: white; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 60px; /* Ukuran default desktop */
            width: auto;
            margin-right: 15px;
            flex-shrink: 0;
        }

        /* STRUKTUR FORMULIR */
        .form-ppdb-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-header h1 {
            font-size: 2rem; 
            font-weight: 800;
            line-height: 1.2;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        
        /* DEFAULT GRID UNTUK DESKTOP (JIKA TIDAK ADA DI style.css) */
        .form-group-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px;
            margin-bottom: 20px;
        }
        
        /* Default styling untuk Fieldset/Legend */
        .form-section {
            border: none;
            padding: 0;
            margin: 20px 0;
        }

        .form-section legend {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
            width: 100%;
        }

        /* Default input/select styling (Agar tidak hilang) */
        .form-field input[type="text"], 
        .form-field input[type="email"], 
        .form-field input[type="date"], 
        .form-field input[type="tel"], 
        .form-field select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }
        
        .back-button {
            padding: 10px 20px;
            margin-right: 10px;
            border: 1px solid #6c757d;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .submit-button {
            padding: 10px 20px;
            border: none;
            background-color: #0d6efd;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:disabled {
            background-color: #99c2ff;
            cursor: not-allowed;
        }

        /* Styling tambahan untuk error message inline */
        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }
        
        .warning-text {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        /* ======================================= */
        /* MEDIA QUERY KHUSUS HP (Max 768px) */
        /* ======================================= */
        @media (max-width: 768px) {
            
            /* HEADER HP */
            .header {
                padding: 8px 3%;
            }

            .logo {
                height: 35px; 
                margin-right: 5px;
            }

            /* FORMULIR HP */
            .form-ppdb-container {
                padding: 10px 15px !important; 
            }
            
            /* KUNCI: Judul Utama Dikecilkan */
            .form-header h1 {
                font-size: 1.5rem; /* Dikecilkan */
                margin-bottom: 10px;
            }
            
            /* KUNCI: Grid Tumpuk (menjadi 1 kolom) */
            .form-group-grid {
                grid-template-columns: 1fr; /* 1 kolom di HP */
                gap: 15px; /* Jarak antar field */
            }
            .form-group-grid.two-columns {
                grid-template-columns: 1fr;
            }
            
            /* KUNCI: Margin dan Padding Input Disesuaikan */
            .form-field input[type="text"], 
            .form-field input[type="email"], 
            .form-field input[type="date"], 
            .form-field input[type="tel"], 
            .form-field select {
                padding: 10px;
                font-size: 0.9rem;
            }


            /* Sub Judul Section */
            .form-section legend {
                font-size: 1.1rem;
                margin-bottom: 15px;
            }

            /* Tombol Aksi Ditumpuk */
            .form-actions {
                display: flex;
                flex-direction: column; 
                gap: 15px;
            }
            
            /* Pastikan tombol di HP mengisi lebar penuh dan hapus margin-right di tombol "Back" */
            .submit-button, .back-button {
                width: 100%; 
                padding: 12px;
                text-align: center;
                margin-right: 0 !important; 
            }
            
            /* Modal Verifikasi HP */
            #verificationModal .modal-content {
                width: 95% !important;
                margin: 5% auto !important;
            }
            
        }
    </style>
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <x-slot name="header">
        <header class="header">
            <div class="header-left">
                <div class="school-info">
                    <a href="/">
                        <img 
                            src="https://mettamaitreya.sch.id/assets/images/logo-header.png" 
                            alt="Logo Sekolah" 
                            class="logo"
                        >
                    </a>
                </div>
            </div>
            <button class="login-button">
                {{-- Tombol Login --}}
            </button>
        </header>
    </x-slot>

    <section class="form-ppdb-container">
        <div class="form-header">
            <h1>Formulir Pendaftaran Peserta Didik Baru (PPDB)</h1>
            <p>Mohon isi data dengan lengkap dan benar sesuai dokumen asli. Formulir ini terhubung ke akun Anda.</p>
        </div>

        {{-- Catatan: Area untuk menampilkan pesan sukses (session('success')) bisa tetap di sini --}}
        @if (session('success'))
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; border-radius: .25rem; color: #155724; background-color: #d4edda;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('formulir.store') }}" enctype="multipart/form-data" class="ppdb-form">
            @csrf

            <fieldset class="form-section">
                <legend>1. Identitas Akun Wali/Orang Tua</legend>

                <div class="form-group-grid">

                    @auth
                        {{-- Field Nama yang TIDAK BISA DIEDIT (read-only) --}}
                        <div class="form-field full-width">
                            <label for="name">Nama Wali/Orang Tua</label>
                            <input type="text" id="name" value="{{ Auth::user()->name }}" disabled readonly>
                        </div>

                        {{-- Email diambil dari users dan tidak bisa diedit --}}
                        <div class="form-field full-width">
                            <label for="email">Email Akun</label>
                            <input type="email" id="email" value="{{ Auth::user()->email }}" disabled readonly>
                        </div>
                    @endauth


                </div>
                <p class="warning-text full-width" style="margin-top: 5px; ">
                    *Jika ingin mengubah data akun (nama/password), silakan buka menu Profile.
                </p>
            </fieldset>

            {{-- BAGIAN 2: Data Pribadi Calon Siswa --}}
            <fieldset class="form-section">
                <legend>2. Data Pribadi Calon Siswa (Wajib)</legend>

                <div class="form-group-grid">

                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        <input type="text" id="nama_pd" name="nama_pd" value="{{ old('nama_pd') }}"
                            autocomplete="off" required>

                        {{-- Menampilkan error spesifik --}}
                        @error('nama_pd')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        <input type="text" id="tlahir" name="tlahir" value="{{ old('tlahir') }}"
                            autocomplete="off" required>
                        @error('tlahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        <input type="date" id="tgllahir" name="tgllahir" value="{{ old('tgllahir') }}"
                            autocomplete="off" required>
                        @error('tgllahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="jk">Jenis Kelamin</label>
                        <select id="jk" name="jk" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            @php
                                $currentJk = old('jk');
                            @endphp
                            @isset($jenisKelamin)
                                @foreach ($jenisKelamin as $jk)
                                    <option value="{{ $jk->id }}" {{ $currentJk == $jk->id ? 'selected' : '' }}>
                                        {{ $jk->jk }}
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
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}"
                            autocomplete="off" required>
                        @error('alamat')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="tingkat">Tingkat Pendaftaran</label>
                        <select id="tingkat" name="tingkat" required>

                            <option value="">Pilih Tingkat</option>

                            @php
                                $currentTingkat = old('tingkat');
                            @endphp
                            @isset($tingkats)
                                @foreach ($tingkats as $tingkat)
                                    <option value="{{ $tingkat->id }}"
                                        {{ $currentTingkat == $tingkat->id ? 'selected' : '' }}>
                                        {{ $tingkat->tingkat }}
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
                <legend>3. Data Orang Tua & Kontak (Wajib)</legend>

                <div class="form-group-grid">

                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        <input type="text" id="namaortu" name="namaortu" autocomplete="off"
                            value="{{ old('namaortu') }}" required>
                        @error('namaortu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        <input type="tel" id="notelportu" name="notelportu" autocomplete="off"
                            value="{{ old('notelportu') }}" required>
                        @error('notelportu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        <input type="text" id="namawali" name="namawali" autocomplete="off"
                            value="{{ old('namawali') }}">
                        @error('namawali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        <input type="tel" id="notelpwali" name="notelpwali" autocomplete="off"
                            value="{{ old('notelpwali') }}">
                        @error('notelpwali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 4: Upload Dokumen Pendukung --}}
            <fieldset class="form-section">
                <legend>4. Upload Dokumen Pendukung</legend>
                <p class="warning-text">Format yang diterima: JPG, PNG, atau PDF. Ukuran maksimal 2MB
                    per file.</p>

                <div class="form-group-grid two-columns">

                    <div class="form-field">
                        <label for="fotoanak">Pas Foto Anak Terbaru (3x4)</label>
                        <input type="file" id="fotoanak" name="fotoanak" accept=".jpg, .png, .pdf" required>
                        @error('fotoanak')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                        <img id="preview_fotoanak" src="" alt="Pratinjau Foto Anak"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>

                    <div class="form-field">
                        <label for="fotokk">Kartu Keluarga (KK) Asli</label>
                        {{-- Perhatikan: name="fotokkk" di sini, tapi id="fotokk" --}}
                        <input type="file" id="fotokk" name="fotokkk" accept=".jpg, .png, .pdf" required>
                        @error('fotokkk')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                        <img id="preview_fotokk" src="" alt="Pratinjau Foto KK"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>
                </div>
            </fieldset>

            <div class="form-actions">
                <a href="{{ url('/') }}" class="back-button">Back</a>
                {{-- Diubah dari type="submit" menjadi type="button" untuk memicu modal --}}
                <button type="button" id="open-verification-modal" class="submit-button">
                    Kirim Formulir Pendaftaran
                </button>
            </div>
        </form>
    </section>

    {{-- =================================================== --}}
    {{-- STRUKTUR MODAL/POP-UP UNTUK VERIFIKASI DATA BARU --}}
    {{-- =================================================== --}}
    <div id="verificationModal" class="modal"
        style="display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 90%; max-width: 600px; text-align: left; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            <div class="modal-header"
                style="border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 15px;">
                <h2 style="margin: 0; color: #007bff; font-weight: 700;">Konfirmasi Data Pendaftaran</h2>
                <p style="margin-top: 5px; font-size: 0.9em; color: #555;">Mohon periksa kembali data di bawah ini sebelum
                    dikirim.</p>
            </div>
            <div class="modal-body">
                <div id="verificationData" style="max-height: 400px; overflow-y: auto; padding-right: 15px;">
                    {{-- Data dari form akan di-inject di sini oleh JavaScript --}}
                </div>
            </div>
            <div class="modal-footer"
                style="padding-top: 15px; margin-top: 20px; border-top: 1px solid #eee; text-align: right;">
                <button type="button" id="backVerificationButton" class="back-button"
                    style="background-color: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                    Back (Edit Formulir)
                </button>
                <button type="button" id="confirmSubmitButton" class="submit-button"
                    style="background-color: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    Kirim Data Pendaftaran
                </button>
            </div>
        </div>
    </div>


    {{-- =================================================== --}}
    {{-- STRUKTUR MODAL/POP-UP UNTUK PESAN KESALAHAN (LAMA, TETAP ADA) --}}
    {{-- =================================================== --}}
    <div id="errorModal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 400px; text-align: center; border-radius: 10px;">
            <div class="modal-header"
                style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
                <span style="font-size: 50px; color: #E57373; display: block; margin-bottom: 10px;">&times;</span>
                <h2 style="margin: 0; color: #721c24;">Kesalahan</h2>
            </div>
            <div class="modal-body">
                <p id="errorMessageTitle" style="font-weight: bold; margin-bottom: 10px; color: #721c24;">Pendaftaran
                    Gagal.</p>
                <div id="errorList" style="text-align: left; max-height: 150px; overflow-y: auto; padding: 0 10px;">
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px; margin-top: 15px; border-top: 1px solid #eee;">
                <button id="closeModalButton" type="button" class="submit-button"
                    style="background-color: #0d6efd; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">OK</button>
            </div>
        </div>
    </div>


    {{-- =================================================== --}}
    {{-- SCRIPT JAVASCRIPT UNTUK PREVIEW FILE DAN POP-UP ERROR/VERIFIKASI --}}
    {{-- =================================================== --}}
    <script>
        function setupImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!input || !img) {
                console.error('Elemen input atau img tidak ditemukan untuk ID:', inputId, imgId);
                return;
            }
            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    // Cek apakah file adalah gambar (untuk preview)
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            img.src = e.target.result;
                            img.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Sembunyikan jika bukan gambar (misalnya PDF)
                        img.style.display = 'none';
                        img.src = '';
                    }
                } else {
                    img.style.display = 'none';
                    img.src = '';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            setupImagePreview('fotoanak', 'preview_fotoanak');
            setupImagePreview('fotokk', 'preview_fotokk'); // ID: fotokk, Name: fotokkk

            const form = document.querySelector('.ppdb-form');
            const originalSubmitButton = document.getElementById('open-verification-modal'); // Tombol awal
            const verificationModal = document.getElementById('verificationModal');
            const verificationDataContainer = document.getElementById('verificationData');
            const backVerificationButton = document.getElementById('backVerificationButton');
            const confirmSubmitButton = document.getElementById('confirmSubmitButton'); // Tombol di dalam modal

            // ===================================================
            // LOGIKA BARU: POP-UP VERIFIKASI DATA
            // ===================================================

            // 1. Fungsi untuk mengumpulkan dan menampilkan data
            function populateVerificationModal() {
                // Kita tentukan field apa saja yang mau ditampilkan
                const fields = [
                    // Bagian 1: Identitas Akun Wali/Orang Tua (Baca saja)
                    { label: 'Nama Akun', id: 'name', source: 'value' },
                    { label: 'Email Akun', id: 'email', source: 'value' },
                    // Bagian 2: Data Pribadi Calon Siswa
                    { label: 'Nama Lengkap Siswa', id: 'nama_pd', source: 'value' },
                    { label: 'Tempat Lahir', id: 'tlahir', source: 'value' },
                    { label: 'Tanggal Lahir', id: 'tgllahir', source: 'value' },
                    { label: 'Jenis Kelamin', id: 'jk', source: 'text' }, 
                    { label: 'Alamat Lengkap', id: 'alamat', source: 'value' },
                    { label: 'Tingkat Pendaftaran', id: 'tingkat', source: 'text' }, 
                    // Bagian 3: Data Orang Tua & Kontak
                    { label: 'Nama Ayah/Ibu Kandung', id: 'namaortu', source: 'value' },
                    { label: 'Nomor HP Orang Tua', id: 'notelportu', source: 'value' },
                    { label: 'Nama Wali (Jika Ada)', id: 'namawali', source: 'value', default: ' - ' },
                    { label: 'Nomor HP Wali', id: 'notelpwali', source: 'value', default: ' - ' },
                    // Bagian 4: Dokumen Pendukung - Diubah logikanya
                    { label: 'Pas Foto Anak', id: 'fotoanak', source: 'fileDisplay' }, 
                    { label: 'Kartu Keluarga (KK)', id: 'fotokk', source: 'fileDisplay' }, 
                ];

                let htmlContent = '<table style="width:100%; font-size:0.95em; border-collapse: collapse;">';

                fields.forEach(field => {
                    const element = document.getElementById(field.id);
                    let displayValue = field.default || '';
                    
                    // --- LOGIC BARU UNTUK TAMPILAN GAMBAR DI MODAL ---
                    if (field.source === 'fileDisplay') {
                        const previewId = `preview_${field.id}`;
                        const previewImg = document.getElementById(previewId);

                        if (previewImg && previewImg.src && previewImg.style.display !== 'none') {
                            // Jika ada pratinjau gambar yang ditampilkan (Base64)
                            displayValue = `<img src="${previewImg.src}" alt="Pratinjau ${field.label}" style="max-width: 150px; max-height: 150px; height: auto; display: block; margin-top: 5px; border: 1px solid #ddd; object-fit: cover;">`;
                        } else if (element && element.files.length > 0) {
                            // Jika ada file tapi bukan gambar (misalnya PDF)
                            displayValue = `File diunggah: ${element.files[0].name} (Kemungkinan PDF/Non-Gambar)`;
                        } else {
                            displayValue = 'Belum diunggah / Data Lama';
                        }
                    } 
                    // --- LOGIC UNTUK FIELD NON-GAMBAR ---
                    else {
                        if (element) {
                            if (field.source === 'value') {
                                displayValue = element.value || field.default || '-';
                            } else if (field.source === 'text' && element.options) {
                                // Untuk <select>
                                let valueText = element.options[element.selectedIndex]?.text;
                                displayValue = valueText && valueText !== 'Pilih Jenis Kelamin' && valueText !== 'Pilih Tingkat' ? valueText : (field.default || '-');
                            }
                        }
                    }

                    // Tambahkan baris ke tabel
                    htmlContent += `
                        <tr>
                            <td style="padding: 8px 0; border-bottom: 1px dashed #eee; width: 45%; font-weight: 600; vertical-align: top;">${field.label}</td>
                            <td style="padding: 8px 0; border-bottom: 1px dashed #eee; width: 5%; text-align: center; vertical-align: top;">:</td>
                            <td style="padding: 8px 0; border-bottom: 1px dashed #eee; color: #333; vertical-align: top;">${displayValue}</td>
                        </tr>
                    `;
                });

                htmlContent += '</table>';
                verificationDataContainer.innerHTML = htmlContent;
            }

            // 2. Event Listener untuk membuka modal verifikasi
            if (originalSubmitButton) {
                originalSubmitButton.addEventListener('click', (e) => {
                    // Cek validitas form bawaan browser (required fields)
                    if (form.checkValidity()) {
                        e.preventDefault(); // Mencegah submit form
                        populateVerificationModal();
                        verificationModal.style.display = 'block';
                    } else {
                        // Jika form tidak valid, biarkan browser menampilkan pesan error bawaannya
                        form.reportValidity(); 
                    }
                });
            }

            // 3. Event Listener untuk tombol "Back (Edit Formulir)"
            if (backVerificationButton) {
                backVerificationButton.onclick = function() {
                    verificationModal.style.display = 'none';
                }
            }

            // 4. Event Listener untuk tombol "Kirim Data Pendaftaran" di dalam modal
            if (confirmSubmitButton) {
                confirmSubmitButton.addEventListener('click', () => {
                    // Tampilkan status loading
                    confirmSubmitButton.disabled = true;
                    confirmSubmitButton.textContent = 'Memproses... Harap Tunggu';
                    
                    // Lakukan submit form
                    form.submit();
                });
            }


            // ===================================================
            // LOGIKA ERROR MODAL YANG SUDAH ADA 
            // ===================================================

            const errorModal = document.getElementById('errorModal');
            const errorListDiv = document.getElementById('errorList');
            const closeModalButton = document.getElementById('closeModalButton');
            const errorMessageTitle = document.getElementById('errorMessageTitle');

            // Fungsi untuk menampilkan modal error
            function showModal(messages, title = 'Pendaftaran Gagal.') {
                errorListDiv.innerHTML = '';
                errorMessageTitle.textContent = title;

                const ul = document.createElement('ul');
                ul.style.listStyleType = 'disc';
                ul.style.paddingLeft = '20px';
                ul.style.margin = '0';

                messages.forEach(msg => {
                    const li = document.createElement('li');
                    li.textContent = msg;
                    ul.appendChild(li);
                });

                errorListDiv.appendChild(ul);
                errorModal.style.display = 'block';
            }

            // Tutup modal ketika tombol OK diklik
            if (closeModalButton) {
                closeModalButton.onclick = function() {
                    errorModal.style.display = 'none';
                }
            }

            // Tutup modal jika user mengklik di luar modal (tambahan untuk verifikasi modal)
            window.onclick = function(event) {
                if (event.target == errorModal) {
                    errorModal.style.display = 'none';
                }
                if (event.target == verificationModal) {
                    verificationModal.style.display = 'none';
                }
            }

            // Cek apakah ada error dari Laravel (Validation Errors atau Session Failure)
            @php
                $allErrors = $errors->all();
                $sessionFailure = session('failure');
                $errorMessages = [];

                if ($sessionFailure) {
                    $errorMessages[] = $sessionFailure;

                    if (!$errors->isEmpty()) {
                        foreach ($allErrors as $error) {
                            if ($error !== $sessionFailure) {
                                $errorMessages[] = $error;
                            }
                        }
                    }
                } elseif (!$errors->isEmpty()) {
                    $errorMessages = $allErrors;
                }
            @endphp

            // Jika ada pesan kesalahan yang dikumpulkan, tampilkan modal
            const messages = {!! json_encode($errorMessages) !!};
            if (messages.length > 0) {
                // Re-enable tombol submit jika gagal, agar user bisa mencoba lagi
                if (originalSubmitButton) {
                    originalSubmitButton.disabled = false;
                    originalSubmitButton.textContent = 'Kirim Formulir Pendaftaran';
                }
                if (confirmSubmitButton) {
                    confirmSubmitButton.disabled = false;
                    confirmSubmitButton.textContent = 'Kirim Data Pendaftaran';
                }
                showModal(messages);
            }
        });
    </script>
</x-app-layout>