<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>

    {{-- Styles --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
       
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100" class="font-sans antialiased"
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
                    <a
                        :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
                        <x-application-logo class="block h-7 w-auto fill-current text-gray-800"
                            style="width: 40px; height: auto;" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                        {{-- MENU ADMIN --}}
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

                {{-- <span id="current-time" class="flex flex-col text-sm text-gray-700 my-auto text-right mr-4"></span>
                <div class="spacetime" style="margin-left: 10px;">|</div> --}}

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
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
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

                {{-- MENU ADMIN --}}
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
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-slot name="header">
        <div style="margin-bottom: 40px;">
            {{-- Header slot --}}
        </div>
    </x-slot>

    <section class="form-ppdb-container" style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
        <div class="form-header">
            <h1>Edit Data Peserta Didik</br>
                ({{ $siswa->nis ?? 'N/A' }} - {{ $formulir->nama_pd }})</h1>
            <p>Perbarui data peserta didik aktif. Hanya NIS dan NISN yang dapat diubah.</p>
        </div>

        {{-- AREA UNTUK MENAMPILKAN PESAN SUKSES/GAGAL --}}
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

        {{-- START: FORM MENGGUNAKAN METHOD PATCH --}}
        <form method="POST" action="{{ route('teacher.data-peserta-didik.update', $siswa->id) }}"
            enctype="multipart/form-data" class="ppdb-form">
            @csrf
            @method('PATCH')

            {{-- BAGIAN 1: Data Peserta Didik & Formulir --}}
            <fieldset class="form-section">
                <legend>1. Data Peserta Didik & Sinkronisasi</legend>

                {{-- FIELD NIS DAN NISN (DAPAT DIEDIT) --}}
                <div class="form-group-grid two-columns">
                    <div class="form-field">
                        <label for="nis">Nomor Induk Siswa (NIS)</label>
                        {{-- NIS BOLEH DIEDIT --}}
                        <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}">
                        @error('nis')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="nisn">Nomor Induk Siswa Nasional (NISN)</label>
                        {{-- NISN BOLEH DIEDIT --}}
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                        @error('nisn')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FIELD TAHUN MASUK (READ-ONLY) --}}
                <div class="form-group-grid two-columns">
                    <div class="form-field">
                        <label for="tahun_masuk_id">Tahun Masuk</label>
                        {{-- TAHUN MASUK READONLY dan nilainya dikirim via hidden input --}}
                        <select id="tahun_masuk_id" readonly style="background-color: #f0f0f0; pointer-events: none;">
                            <option value="">Pilih Tahun Masuk</option>
                            @isset($tahunMasuk)
                                @foreach ($tahunMasuk as $tahun)
                                    <option value="{{ $tahun->id }}"
                                        {{ old('tahun_masuk_id', $siswa->tahun_masuk_id) == $tahun->id ? 'selected' : '' }}>
                                        {{ $tahun->thnmasuk }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        {{-- Input Hidden untuk mengirim nilai tahun_masuk_id --}}
                        <input type="hidden" name="tahun_masuk_id"
                            value="{{ old('tahun_masuk_id', $siswa->tahun_masuk_id) }}">
                        @error('tahun_masuk_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        {{-- Field Tingkat HANYA TAMPILAN (READONLY) --}}
                        <label>Tingkat</label>
                        <input type="text" value="{{ $formulir->tingkat->tingkat ?? 'N/A' }}" readonly
                            style="background-color: #f0f0f0;">

                        {{-- PERBAIKAN: Input Hidden untuk tingkat_id agar terkirim ke controller --}}
                        <input type="hidden" name="tingkat_id"
                            value="{{ old('tingkat_id', $siswa->tingkat_id ?? $formulir->tingkat_id) }}">
                        @error('tingkat_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        {{-- AKHIR PERBAIKAN --}}
                    </div>
                </div>

                <hr style="margin-top: 30px; margin-bottom: 20px; border-top: 1px solid #ccc;">

                {{-- Data Formulir Terkait (SEMUA READ-ONLY) --}}
                <legend style="margin-bottom: 10px;">Data Formulir Terkait</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="text" id="nama_pd" readonly style="background-color: #f0f0f0;"
                            value="{{ old('nama_pd', $formulir->nama_pd) }}" required>
                        <input type="hidden" name="nama_pd" value="{{ old('nama_pd', $formulir->nama_pd) }}">
                        @error('nama_pd')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="text" id="tlahir" readonly style="background-color: #f0f0f0;"
                            value="{{ old('tlahir', $formulir->tlahir) }}" required>
                        <input type="hidden" name="tlahir" value="{{ old('tlahir', $formulir->tlahir) }}">
                        @error('tlahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="date" id="tgllahir" readonly style="background-color: #f0f0f0;"
                            value="{{ old('tgllahir', $formulir->tgllahir) }}" required>
                        <input type="hidden" name="tgllahir" value="{{ old('tgllahir', $formulir->tgllahir) }}">
                        @error('tgllahir')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="jenis_kelamin_id">Jenis Kelamin</label>
                        {{-- READONLY (pointer-events: none), kirim nilai via hidden input --}}
                        <select id="jenis_kelamin_id" readonly style="background-color: #f0f0f0; pointer-events: none;">
                            <option value="">Pilih Jenis Kelamin</option>
                            @isset($jenisKelamin)
                                @foreach ($jenisKelamin as $jkItem)
                                    <option value="{{ $jkItem->id }}"
                                        {{ old('jenis_kelamin_id', $formulir->jenis_kelamin_id) == $jkItem->id ? 'selected' : '' }}>
                                        {{ $jkItem->jk }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <input type="hidden" name="jenis_kelamin_id"
                            value="{{ old('jenis_kelamin_id', $formulir->jenis_kelamin_id) }}">
                        @error('jenis_kelamin_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field full-width">
                        <label for="alamat">Alamat Lengkap</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="text" id="alamat" readonly style="background-color: #f0f0f0;"
                            value="{{ old('alamat', $formulir->alamat) }}">
                        <input type="hidden" name="alamat" value="{{ old('alamat', $formulir->alamat) }}">
                        @error('alamat')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 2: Data Orang Tua & Kontak (SEMUA READ-ONLY) --}}
            <fieldset class="form-section">
                <legend>2. Data Orang Tua & Kontak (Read-Only)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="text" id="namaortu" readonly style="background-color: #f0f0f0;"
                            value="{{ old('namaortu', $formulir->namaortu) }}">
                        <input type="hidden" name="namaortu" value="{{ old('namaortu', $formulir->namaortu) }}">
                        @error('namaortu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="tel" id="notelportu" readonly style="background-color: #f0f0f0;"
                            value="{{ old('notelportu', $formulir->notelportu) }}">
                        <input type="hidden" name="notelportu"
                            value="{{ old('notelportu', $formulir->notelportu) }}">
                        @error('notelportu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="text" id="namawali" readonly style="background-color: #f0f0f0;"
                            value="{{ old('namawali', $formulir->namawali) }}">
                        <input type="hidden" name="namawali" value="{{ old('namawali', $formulir->namawali) }}">
                        @error('namawali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        {{-- READONLY, kirim nilai via hidden input --}}
                        <input type="tel" id="notelpwali" readonly style="background-color: #f0f0f0;"
                            value="{{ old('notelpwali', $formulir->notelpwali) }}">
                        <input type="hidden" name="notelpwali"
                            value="{{ old('notelpwali', $formulir->notelpwali) }}">
                        @error('notelpwali')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </fieldset>

            {{-- BAGIAN 3: Dokumen Pendukung (Foto Anak Read-Only) --}}
            <fieldset class="form-section">
                <legend>3. Dokumen Pendukung (Read-Only)</legend>

                <div class="form-group-grid two-columns">

                    {{-- PAS FOTO ANAK (Hanya Tampilan Read-Only) --}}
                    <div class="form-field">
                        <label>Pas Foto Anak Terbaru (3x4)</label>
                        @php
                            $currentFotoPath = $siswa->fotoanak ?? $formulir->fotoanak;
                            $currentFotoUrl = $currentFotoPath ? Storage::disk('gcs')->url($currentFotoPath) : null;
                            $isImage = $currentFotoUrl && !Str::endsWith($currentFotoPath, '.pdf');
                        @endphp

                        <div class="mt-2">
                            @if ($currentFotoUrl)
                                <p class="text-sm text-gray-500 mb-2">File saat ini (Sumber: Peserta Didik/Formulir):
                                    <a href="{{ $currentFotoUrl }}" target="_blank"
                                        class="text-blue-600 hover:underline">Lihat File</a>
                                </p>

                                @if ($isImage)
                                    <img src="{{ $currentFotoUrl }}" alt="Foto Siswa"
                                        style="max-width: 150px; max-height: 150px; object-fit: cover; border: 1px solid #ccc;">
                                @else
                                    <p class="text-sm text-red-500">File non-gambar (PDF).</p>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">Belum ada file foto.</p>
                            @endif
                        </div>
                        {{-- Input Hidden untuk fotoanak agar nilainya tetap terkirim saat update --}}
                        <input type="hidden" name="fotoanak"
                            value="{{ old('fotoanak', $siswa->fotoanak ?? $formulir->fotoanak) }}">
                    </div>
                </div>
            </fieldset>

            <div class="form-actions">
                {{-- Tombol Batal --}}
                <a href="{{ route('teacher.data-peserta-didik') }}" class="back-button"
                    style="margin-right: 10px;">Kembali</a>
                {{-- Tombol SIMPAN --}}
                <button type="submit"
                    class="submit-button bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
            </div>
        </form>
        {{-- END: FORM MENGGUNAKAN METHOD PATCH --}}
    </section>

    {{-- SCRIPT POP-UP NOTIFIKASI SUKSES --}}
    @if (session('update_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update data Berhasil!',
                text: 'Data peserta didik {{ $formulir->nama_pd }} telah berhasil diperbarui.',
                position: 'top',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    @endif
    @extends('templates.footer')
</body>

</html>
