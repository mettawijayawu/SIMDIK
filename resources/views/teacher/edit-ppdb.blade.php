<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>

    {{-- Styles --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <x-slot name="header">
        <div style="margin-bottom: 40px;">
        </div>
    </x-slot>

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100"
    style="min-height: 70vh;
    background-image: url('{{ asset('img/smm.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">

    <nav x-data="{ open: false }" class="fixed top-0 w-full z-10 bg-white border-b border-white-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                            <x-application-logo class="block h-7 w-auto fill-current text-gray-800"
                                style="width: 40px; height: auto;" />
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.data-peserta-didik')" :active="request()->routeIs('teacher.datapesertadidik')">
                            {{ __('Data Peserta Didik') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.data-ppdb')" :active="request()->routeIs('teacher.datappdb')">
                            {{ __('Data PPDB') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.informasi')" :active="request()->routeIs('teacher.informasi')">
                            {{ __('Informasi') }}
                        </x-nav-link>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.data-peserta-didik')" :active="request()->routeIs('teacher.datapesertadidik')">
                    {{ __('Data Peserta Didik') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.data-ppdb')" :active="request()->routeIs('teacher.datappdb')">
                    {{ __('Data PPDB') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.informasi')" :active="request()->routeIs('teacher.informasi')">
                    {{ __('Informasi') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <section class="form-ppdb-container" style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
        <div class="form-header">
            <h1>Edit Formulir Pendaftaran Peserta Didik Baru <br>
                ({{ $formulir->no_form }})</h1>
            <p>Perbarui data anak Anda di bawah ini. Dokumen dan perubahan akan diverifikasi ulang.</p>
        </div>

        @if (session('success'))
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; border-radius: .25rem; color: #155724; background-color: #d4edda;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <p style="font-weight: bold; margin-top: 0;">Pembaruan gagal karena kesalahan berikut:</p>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('failure'))
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                {{ session('failure') }}
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.data-ppdb.update', $formulir->no_form) }}" enctype="multipart/form-data" class="ppdb-form">
            @csrf
            @method('PATCH')

            {{-- BAGIAN 1: Data Pribadi --}}
            <fieldset class="form-section">
                <legend>1. Data Pribadi Calon Siswa (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        <input type="text" id="nama_pd" name="nama_pd" value="{{ old('nama_pd', $formulir->nama_pd) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        <input type="text" id="tlahir" name="tlahir" value="{{ old('tlahir', $formulir->tlahir) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        <input type="date" id="tgllahir" name="tgllahir" value="{{ old('tgllahir', $formulir->tgllahir) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="jk">Jenis Kelamin</label>
                        <select id="jk" name="jk" required>
                            <option value="" disabled hidden>Pilih Jenis Kelamin</option>
                            @isset($jenisKelamin)
                                @foreach ($jenisKelamin as $jkItem)
                                    <option value="{{ $jkItem->id }}" {{ old('jk', $formulir->jenis_kelamin_id) == $jkItem->id ? 'selected' : '' }}>{{ $jkItem->jk }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-field full-width">
                        <label for="alamat">Alamat Lengkap</label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $formulir->alamat) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="tingkat">Tingkat Pendaftaran</label>
                        <select id="tingkat" name="tingkat" required>
                            <option value="" disabled hidden>Pilih Tingkat</option>
                            @isset($tingkats)
                                @foreach ($tingkats as $tingkatItem)
                                    <option value="{{ $tingkatItem->id }}" {{ old('tingkat', $formulir->tingkat_id) == $tingkatItem->id ? 'selected' : '' }}>{{ $tingkatItem->tingkat }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 2: Data Orang Tua --}}
            <fieldset class="form-section">
                <legend>2. Data Orang Tua & Kontak (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        <input type="text" id="namaortu" name="namaortu" value="{{ old('namaortu', $formulir->namaortu) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        <input type="tel" id="notelportu" name="notelportu" value="{{ old('notelportu', $formulir->notelportu) }}" required>
                    </div>
                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        <input type="text" id="namawali" name="namawali" value="{{ old('namawali', $formulir->namawali) }}">
                    </div>
                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        <input type="tel" id="notelpwali" name="notelpwali" value="{{ old('notelpwali', $formulir->notelpwali) }}">
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 3: Upload Dokumen --}}
            <fieldset class="form-section">
                <legend>3. Upload Dokumen Pendukung</legend>
                <p class="warning-text">Format yang diterima: JPG, PNG, atau PDF. Ukuran maksimal 2MB per file. Kosongkan jika tidak ada perubahan.</p>
                <div class="form-group-grid two-columns">
                    <div class="form-field">
                        <label for="fotoanak">Pas Foto Anak Terbaru (3x4)</label>
                        <input type="file" id="fotoanak" name="fotoanak" accept=".jpg, .png, .pdf">
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            @if ($formulir->fotoanak)
                                <a href="{{ Storage::disk('gcs')->url($formulir->fotoanak) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                            @else Belum ada file. @endif
                        </p>
                        <img id="preview_fotoanak" src="" alt="Pratinjau Foto Anak" style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>
                    <div class="form-field">
                        <label for="fotokkk">Kartu Keluarga (KK) Asli</label>
                        <input type="file" id="fotokkk" name="fotokkk" accept=".jpg, .png, .pdf">
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            @if ($formulir->fotokkk)
                                <a href="{{ Storage::disk('gcs')->url($formulir->fotokkk) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                            @else Belum ada file. @endif
                        </p>
                        <img id="preview_fotokk" src="" alt="Pratinjau Foto KK" style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 4: Update Status (KHUSUS Guru/Admin) --}}
            @auth
                @if (Auth::user()->isTeacher())
                    <fieldset class="form-section">
                        <legend>4. Status Pendaftaran, Data Siswa Aktif & Catatan Admin</legend>
                        
                        {{-- Field Hidden untuk Status Form (Diproses Latar Belakang) --}}
                        <input type="hidden" id="status_form" name="status_form" value="{{ old('status_form', $formulir->status_form) }}">

                        <div class="form-group-grid two-columns">
                            {{-- Dropdown Status Utama --}}
                            <div class="form-field">
                                <label for="status_id">Status Formulir Saat Ini</label>
                                <select id="status_id" name="status_id" required onchange="runBackgroundLogic()">
                                    <option value="" disabled hidden>Pilih Status</option>
                                    @foreach ($statusList as $statusItem)
                                        <option value="{{ $statusItem->id }}" 
                                            data-name="{{ strtolower($statusItem->status) }}"
                                            {{ old('status_id', $formulir->status_id) == $statusItem->id ? 'selected' : '' }}>
                                            {{ $statusItem->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown Tahun Masuk (Visible tapi Terisi Otomatis) --}}
                            <div class="form-field">
                                <label for="tahun_masuk_id">Tahun Masuk (Jika Diterima)</label>
                                <select id="tahun_masuk_id" name="tahun_masuk_id">
                                    <option value="">Pilih Tahun (Otomatis jika kosong)</option>
                                    @foreach ($tahunMasukList as $tahunItem)
                                        <option value="{{ $tahunItem->id }}"
                                            {{ old('tahun_masuk_id', $formulir->pesertaDidik->tahun_masuk_id ?? $formulir->tahun_masuk_id) == $tahunItem->id ? 'selected' : '' }}>
                                            {{ $tahunItem->thnmasuk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-field full-width">
                                <label for="note">Catatan Admin (Untuk Siswa/Wali)</label>
                                <textarea id="note" name="note" rows="3">{{ old('note', $formulir->note) }}</textarea>
                            </div>
                        </div>
                    </fieldset>
                @else
                    {{-- Hidden input jika user bukan teacher --}}
                    <input type="hidden" name="status_id" value="{{ $formulir->status_id }}">
                    <input type="hidden" name="status_form" value="{{ $formulir->status_form }}">
                    <input type="hidden" name="note" value="{{ $formulir->note }}">
                    <input type="hidden" name="tahun_masuk_id" value="{{ $formulir->pesertaDidik->tahun_masuk_id ?? $formulir->tahun_masuk_id }}">
                @endif
            @endauth

            <div class="form-actions">
                <a href="{{ route('teacher.data-ppdb') }}" class="back-button" style="margin-right: 10px;">Batal</a>
                <button type="submit" class="back-button" style="background-color: blue;">Simpan Pembaruan</button>
            </div>
        </form>
    </section>

    {{-- SCRIPTS --}}
    <script>
        // Logika Preview Gambar
        function setupImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!input || !img) return;
            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => { img.src = e.target.result; img.style.display = 'block'; }
                    reader.readAsDataURL(file);
                } else { img.style.display = 'none'; img.src = ''; }
            });
        }

        // Logika Otomatisasi Latar Belakang
        function runBackgroundLogic() {
            const statusSelect = document.getElementById('status_id');
            if (!statusSelect) return;

            const selectedOption = statusSelect.options[statusSelect.selectedIndex];
            const statusName = selectedOption.getAttribute('data-name') || '';
            
            const inputStatusForm = document.getElementById('status_form');
            const selectTahun = document.getElementById('tahun_masuk_id');
            
            // Mengambil ID Tahun Terbaru dari baris pertama list (laravel collection first)
            const idTahunTerbaru = "{{ $tahunMasukList->first()->id ?? '' }}";

            // 1. Logika Lock/Unlock Otomatis
            if (statusName.includes('menunggu') || statusName.includes('tolak')) {
                inputStatusForm.value = 'unlocked';
            } else if (statusName.includes('terima') || statusName.includes('batal')) {
                inputStatusForm.value = 'locked';
            }

            // 2. Logika Tahun Masuk Otomatis (Tanpa Menimpa Pilihan Manual)
            if (statusName.includes('terima')) {
                // HANYA isi otomatis jika Guru belum memilih tahun (masih kosong)
                if (selectTahun.value === '') {
                    selectTahun.value = idTahunTerbaru;
                    // Flash effect untuk memberitahu user ada pengisian otomatis
                    selectTahun.style.backgroundColor = '#e0f2fe';
                    setTimeout(() => { selectTahun.style.backgroundColor = ''; }, 800);
                }
            } else {
                // Jika status bukan diterima, tahun sebaiknya dikosongkan/reset
                selectTahun.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setupImagePreview('fotoanak', 'preview_fotoanak');
            setupImagePreview('fotokkk', 'preview_fotokk');

            // Load gambar lama
            const fAnak = "{{ $formulir->fotoanak ? Storage::disk('gcs')->url($formulir->fotoanak) : '' }}";
            const fKK = "{{ $formulir->fotokkk ? Storage::disk('gcs')->url($formulir->fotokkk) : '' }}";
            if (fAnak && !fAnak.endsWith('.pdf')) { document.getElementById('preview_fotoanak').src = fAnak; document.getElementById('preview_fotoanak').style.display = 'block'; }
            if (fKK && !fKK.endsWith('.pdf')) { document.getElementById('preview_fotokk').src = fKK; document.getElementById('preview_fotokk').style.display = 'block'; }
        });
    </script>

    @if (session('update_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update data Berhasil!',
                text: 'Data formulir No. {{ $formulir->no_form }} telah berhasil diperbarui.',
                position: 'top',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });
        </script>
    @endif

    @extends('templates.footer')
</body>
</html>