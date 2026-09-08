<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>

    {{-- Styles --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

        <style>

        @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
        }
        
    </style>
    <x-slot name="header">
        <div style="margin-bottom: 40px;">
            {{-- Header slot --}}
        </div>

        {{-- Link Font Awesome Dibiarkan di sini untuk menjaga kemungkinan ikon dimuat di tempat lain --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJc5Dk7I6rW6T2z0P9r8Y5T6v3L9l2Fm4g3W3w5l05L09qKj6O9l5t1J5u7F+Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


    </x-slot>
            
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


    <div style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Welcome Card (DIBIARKAN SAMA) --}}
            <div class="py-10 bg-cover bg-center" style="margin-top: 20px;">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __('Welcome Back, ') }}<span class="font-semibold">{{ Auth::user()->username }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

                {{-- Bagian Notifikasi --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('failure'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('failure') }}</span>
                    </div>
                @endif

                {{-- START: CARD PENGATURAN GELOMBANG UTAMA --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">🗓️ Pengaturan Gelombang PPDB</h3>

                        {{-- CONTAINER GRID KIRI-KANAN: FORM TAMBAH (Kiri) dan DAFTAR (Kanan) --}}
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-8">

                            {{-- KOLOM KIRI (3/5 LEBAR): FORM TAMBAH GELOMBANG --}}
                            <div class="lg:col-span-3">
                                <div class="p-6 border border-blue-200 rounded-lg bg-blue-50 h-full">
                                    <h4 class="text-xl font-semibold text-blue-800 mb-4">Form Tambah Gelombang</h4>
                                    <form action="{{ route('teacher.gelombang.store') }}" method="POST"
                                        class="space-y-4">
                                        @csrf
                                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                                <x-input-label for="nama_gelombang" :value="__('Nama Gelombang')" />
                                                <x-text-input id="nama_gelombang" name="nama_gelombang" type="text"
                                                    class="mt-1 block w-full" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('nama_gelombang')" />
                                            </div>
                                            <div>
                                                <x-input-label for="tgl_buka" :value="__('Tanggal Buka')" />
                                                <x-text-input id="tgl_buka" name="tgl_buka" type="date"
                                                    class="mt-1 block w-full" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('tgl_buka')" />
                                            </div>
                                            <div>
                                                <x-input-label for="tgl_tutup" :value="__('Tanggal Tutup')" />
                                                <x-text-input id="tgl_tutup" name="tgl_tutup" type="date"
                                                    class="mt-1 block w-full" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('tgl_tutup')" />
                                            </div>
                                            <div class="flex items-end pt-4">
                                                <x-primary-button class="w-full justify-center"
                                                    style="background-color: green; color: white;">Tambah</x-primary-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- KOLOM KANAN (2/5 LEBAR): DAFTAR GELOMBANG RINGKAS (Card) --}}
                            <div class="lg:col-span-2">
                                <h4 class="text-xl font-semibold text-gray-800 mb-4">Tabel Gelombang</h4>
                                <div class="space-y-3">
                                    @forelse ($gelombangs as $gelombang)
                                        <div class="p-4 border rounded-lg shadow-sm {{ $gelombang->is_active ? 'border-green-400 bg-green-50' : 'border-gray-200 bg-white' }}"
                                            x-data="{ openModal: false }">

                                            {{-- Struktur tampilan Ringkas --}}
                                            <div class="flex justify-between items-start">

                                                {{-- Kiri: Nama & Tanggal --}}
                                                <div>
                                                    <p
                                                        class="font-bold text-base {{ $gelombang->is_active ? 'text-green-800' : 'text-gray-800' }}">
                                                        {{ $gelombang->nama_gelombang }}
                                                        @if ($gelombang->is_active)
                                                            <span
                                                                class="text-xs font-normal text-green-600">(Aktif)</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $gelombang->tgl_buka->format('d/m/Y') }} -
                                                        {{ $gelombang->tgl_tutup->format('d/m/Y') }}
                                                    </p>
                                                </div>

                                                {{-- Kanan: Tombol Aksi (Edit & Hapus) --}}
                                                <div class="flex space-x-2 mt-1">
                                                    {{-- TOMBOL EDIT (MEMBUKA MODAL) --}}
                                                    <x-secondary-button @click="openModal = true" type="button"
                                                        title="Edit Gelombang" class="px-2 py-1 text-xs">
                                                        Edit
                                                    </x-secondary-button>

                                                    {{-- Tombol Hapus --}}
                                                    <form
                                                        action="{{ route('teacher.gelombang.destroy', $gelombang->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus gelombang {{ $gelombang->nama_gelombang }}?');"
                                                        class="inline">
                                                        @csrf @method('DELETE')
                                                        <x-danger-button type="submit" title="Hapus Gelombang"
                                                            class="px-2 py-1 text-xs">
                                                            Hapus
                                                        </x-danger-button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- START: MODAL EDIT GELOMBANG (Popup Menu) --}}
                                            <div x-show="openModal"
                                                class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 flex items-center justify-center p-4"
                                                x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0" style="display: none;">

                                                <div @click.away="openModal = false"
                                                    class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto p-6"
                                                    x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                    <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Gelombang:
                                                        {{ $gelombang->nama_gelombang }}</h3>

                                                    <form
                                                        action="{{ route('teacher.gelombang.update', $gelombang->id) }}"
                                                        method="POST" class="space-y-4">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- Input Nama Gelombang --}}
                                                        <div>
                                                            <x-input-label for="modal_nama_{{ $gelombang->id }}"
                                                                :value="__('Nama Gelombang')" />
                                                            <x-text-input id="modal_nama_{{ $gelombang->id }}"
                                                                name="nama_gelombang" type="text"
                                                                class="mt-1 block w-full"
                                                                value="{{ $gelombang->nama_gelombang }}" required />
                                                        </div>

                                                        {{-- Input Tanggal Buka --}}
                                                        <div>
                                                            <x-input-label for="modal_buka_{{ $gelombang->id }}"
                                                                :value="__('Tanggal Buka')" />
                                                            <x-text-input id="modal_buka_{{ $gelombang->id }}"
                                                                name="tgl_buka" type="date"
                                                                class="mt-1 block w-full"
                                                                value="{{ $gelombang->tgl_buka->format('Y-m-d') }}"
                                                                required />
                                                        </div>

                                                        {{-- Input Tanggal Tutup --}}
                                                        <div>
                                                            <x-input-label for="modal_tutup_{{ $gelombang->id }}"
                                                                :value="__('Tanggal Tutup')" />
                                                            <x-text-input id="modal_tutup_{{ $gelombang->id }}"
                                                                name="tgl_tutup" type="date"
                                                                class="mt-1 block w-full"
                                                                value="{{ $gelombang->tgl_tutup->format('Y-m-d') }}"
                                                                required />
                                                        </div>

                                                        {{-- Tombol Aksi Modal --}}
                                                        <div class="flex justify-end space-x-3 pt-4">
                                                            <x-secondary-button @click="openModal = false"
                                                                type="button">Batal</x-secondary-button>
                                                            <x-primary-button type="submit">Simpan
                                                                Perubahan</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- END MODAL --}}

                                        </div>
                                    @empty
                                        <div class="p-4 border rounded-lg shadow-sm bg-gray-50 text-center">
                                            <p class="text-gray-500 italic">Belum ada data gelombang PPDB.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        {{-- END: CONTAINER GRID KIRI-KANAN --}}
                    </div>
                </div>
                {{-- END: CARD PENGATURAN GELOMBANG UTAMA --}}

                <hr>

                {{-- START: CARD PENGATURAN FOTO HOMEPAGE --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">📸 Pengaturan Foto Halaman Utama</h3>

                        <form action="{{ route('teacher.update.foto.homepage') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Kolom Kiri: Preview Foto Lama --}}
                                <div>
                                    <x-input-label :value="__('Foto Saat Ini')" class="mb-2" />
                                    @if (isset($fotoHomepage))
                                        @php
                                            $url = Storage::url($fotoHomepage);
                                        @endphp
                                        <img src="{{ $url }}" alt="Foto Homepage Saat Ini"
                                            class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-300">
                                        <p class="text-sm text-gray-500 mt-2">File: {{ basename($fotoHomepage) }}</p>
                                    @else
                                        <div class="bg-gray-100 p-6 rounded-lg text-center text-gray-500">
                                            Belum ada foto yang diunggah.
                                        </div>
                                    @endif
                                </div>

                                {{-- Kolom Kanan: Form Upload --}}
                                <div>
                                    <x-input-label for="foto_homepage" :value="__('Upload Foto Baru (Max 4MB, JPG/PNG)')" />
                                    <input id="foto_homepage" name="foto_homepage" type="file"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('foto_homepage')" />

                                    <x-primary-button class="mt-4 w-full justify-center">Update Foto</x-primary-button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- END: CARD PENGATURAN FOTO HOMEPAGE --}}

            </div>
        </div>
    </div>
    @extends('templates.footer')
</body>

</html>

