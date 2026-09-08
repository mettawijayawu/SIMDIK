<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM - Kelola Data</title>

    {{-- Styles --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* CSS Tambahan untuk konsistensi layout */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 5%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo { height: 60px; width: auto; margin-right: 15px; flex-shrink: 0; }
        @media (max-width: 768px) { .logo { height: 35px; margin-right: 5px; } }

        /* Gaya Tabel CRUD */
        .data-table-container { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { padding: 12px 15px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        .data-table th { background-color: #f7f7f7; font-weight: 600; color: #4a5568; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100" class="font-sans antialiased"
    style="min-height: 70vh;
    background-image: url('{{ asset('img/smm.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">

<nav x-data="{ open: false }" class="fixed top-0 w-full z-10 bg-white border-b border-white-100"> {{-- Z-index diubah ke 10 agar di atas konten --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    {{-- LOGO ROUTE - MENGARAHKAN KE DASHBOARD YANG TEPAT --}}
                    <a
                        href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('teacher.dashboard') }}">
                        <x-application-logo class="block h-7 w-auto fill-current text-gray-800"
                            style="width: 40px; height: auto;" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    {{-- MENU ADMIN UTAMA --}}
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard Admin') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                        {{ __('Data User') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.kelola')" :active="request()->routeIs('admin.kelola')">
                        {{ __('Kelola') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Dropdown Profile (Sama untuk semua staf) --}}
            <div class="hidden sm:flex sm:items-center">
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

            {{-- Tombol Burger (Sama) --}}
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

    {{-- Menu Responsif (Mobile) --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- MENU RESPONSIF ADMIN UTAMA --}}
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard Admin') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                {{ __('Data User') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kelola')" :active="request()->routeIs('admin.kelola')">
                {{ __('Kelola') }}
            </x-responsive-nav-link>

        </div>

        {{-- Profile Responsif (Sama untuk semua staf) --}}
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

<div style="min-height: 85vh; margin-bottom: 40px; padding-top: 80px;"> {{-- Tambah padding-top untuk fixed navbar --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- JUDUL HALAMAN (Diambil dari "Welcome Card" sebelumnya) --}}
        <div class="py-5 bg-cover bg-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <span class="font-semibold text-2xl">Kelola Data Tahun Masuk dan Tingkat</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Session --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- =========================================== --}}
        {{-- I. KELOLA TAHUN MASUK (FORM & TABEL) --}}
        {{-- =========================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- I.A. FORM TAMBAH TAHUN MASUK --}}
            <div class="bg-white p-6 shadow-xl rounded-lg h-full">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">
                    ➕ Tambah Tahun Masuk
                </h3>
                
                <form action="{{ route('admin.kelola.tahun.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="thnmasuk" class="block text-sm font-medium text-gray-700">Tahun Masuk</label>
                        {{-- Menggunakan nama input 'thnmasuk' sesuai Controller --}}
                        <input type="text" name="thnmasuk" id="thnmasuk" 
                               value="{{ old('thnmasuk') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               placeholder="Contoh: 2024/2025" required>
                        @error('thnmasuk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md">
                        Simpan Tahun
                    </button>
                </form>
            </div>

            {{-- I.B. TABEL DATA TAHUN MASUK --}}
            <div class="bg-white p-6 shadow-xl rounded-lg data-table-container">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">
                    📋 Daftar Tahun Masuk
                </h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tahun Masuk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_tahun as $item)
                            <tr>
                                {{-- Menggunakan kolom 'thnmasuk' --}}
                                <td>{{ $item->thnmasuk }}</td> 
                                <td class="text-center">
                                    <form action="{{ route('admin.kelola.tahun.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white text-xs py-1 px-3 rounded"
                                                onclick="return confirm('Hapus Tahun {{ $item->thnmasuk }}?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-gray-500">Data Tahun Masuk Kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="my-6"></div> 

        {{-- =========================================== --}}
        {{-- II. KELOLA TINGKAT/LEVEL (FORM & TABEL) --}}
        {{-- =========================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- II.A. FORM TAMBAH TINGKAT --}}
            <div class="bg-white p-6 shadow-xl rounded-lg h-full">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">
                    ➕ Tambah Tingkat
                </h3>
                
                <form action="{{ route('admin.kelola.tingkat.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="tingkat" class="block text-sm font-medium text-gray-700">Nama Tingkat</label>
                        {{-- Menggunakan nama input 'tingkat' sesuai Controller --}}
                        <input type="text" name="tingkat" id="tingkat"
                               value="{{ old('tingkat') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               placeholder="Contoh: PAUD, SD, SMP, SMK" required>
                        @error('tingkat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md">
                        Simpan Tingkat
                    </button>
                </form>
            </div>

            {{-- II.B. TABEL DATA TINGKAT --}}
            <div class="bg-white p-6 shadow-xl rounded-lg data-table-container">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">
                    📋 Daftar Tingkat/Level
                </h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Tingkat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_tingkat as $item)
                            <tr>
                                {{-- Menggunakan kolom 'tingkat' --}}
                                <td>{{ $item->tingkat }}</td> 
                                <td class="text-center">
                                    <form action="{{ route('admin.kelola.tingkat.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white text-xs py-1 px-3 rounded"
                                                onclick="return confirm('Hapus Tingkat {{ $item->tingkat }}?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-gray-500">Data Tingkat Kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@extends('templates.footer')
</body>
</html>