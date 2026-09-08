<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>

    {{-- Styles --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
        
    {{-- STYLING RESPONSIVITAS BARU --}}
    <style>
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

        /* STRUKTUR FILTER: Mengatur tata letak Filter dan Tombol Cetak */
        .filter-controls-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; 
        }

        #filter-form {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap; 
        }

        .filter-group {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .filter-group label {
            margin-right: 10px;
            font-weight: 600;
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
                height: 35px; /* LOGO DIKECILKAN DI HP */
                margin-right: 5px;
            }
            
            /* FILTER HP: DITUMPUK VERTIKAL */
            .filter-controls-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            #filter-form {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                width: 100%;
            }
            
            .filter-group {
                width: 100%;
                justify-content: space-between;
            }

            .filter-group label {
                flex-shrink: 0;
            }

            .filter-group select {
                width: 60% !important; /* Agar select box mengambil sebagian besar ruang */
            }
            
            /* TABEL HP: Mengaktifkan Gulir Horizontal dan Penyesuaian Kolom */
            .overflow-x-auto {
                padding: 0 5px;
            }
            
            .table-auto {
                min-width: 750px; /* Memastikan tabel digulir secara horizontal */
            }
            
            .table-auto th, .table-auto td {
                padding: 8px 10px;
                font-size: 0.75rem; 
            }
            
            /* Penyesuaian lebar kolom spesifik */
            .table-auto td img {
                width: 30px; 
                height: 30px;
            }
            
            .table-auto th:nth-child(4), /* Nama Siswa */
            .table-auto td:nth-child(4) {
                min-width: 150px; /* Lebarkan kolom Nama Siswa */
            }
            
            .table-auto td:nth-child(8) a {
                padding: 4px 6px; 
            }
            
            .footer {
                font-size: 0.6em;
            }
        }
    </style>
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
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                                style="color: white;">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" style="color: white;">Login</a>
                        @endauth
                    </div>
                @endif
            </button>
        </header>
    </x-slot>

    <div style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" style="min-height: 80vh;">

            {{-- WELCOME CARD --}}
            <div class="py-10 bg-cover bg-center" style="margin-top: 20px;">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __('Welcome Back, ') }}<span class="font-semibold">{{ Auth::user()->username }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">

                <div class="p-6">
                    {{-- - KONTROL FILTER & CETAK PDF - --}}
                    <div class="mb-6 mt-6">
                        <h3 class="text-lg font-semibold mb-3">Filter Data Formulir PPDB</h3>

                        <div class="filter-controls-container">
                            {{-- FORM FILTER UTAMA (Submit Otomatis) --}}
                            <form id="filter-form" action="{{ route('teacher.data-ppdb') }}" method="GET">

                                {{-- FILTER TINGKAT --}}
                                <div class="filter-group">
                                    <label for="tingkat-filter">Tingkat:</label>
                                    <select name="tingkat_filter" id="tingkat-filter"
                                        class="py-2 px-5 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-40">
                                        <option value="" @selected(request('tingkat_filter') == '')>All</option>
                                        @foreach ($tingkatList as $tingkat)
                                            <option value="{{ $tingkat->id }}" @selected(request('tingkat_filter') == $tingkat->id)>
                                                {{ $tingkat->tingkat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- FILTER STATUS --}}
                                <div class="filter-group">
                                    <label for="status-filter">Status:</label>
                                    <select name="status_filter" id="status-filter"
                                        class="py-2 px-5 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-40">
                                        <option value="">All</option>
                                        @foreach ($statusList as $status)
                                            <option value="{{ $status->id }}" @selected(request('status_filter') == $status->id)>
                                                {{ $status->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Tombol Reset Filter --}}
                                <a href="{{ route('teacher.data-ppdb') }}"
                                    class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 font-medium">
                                    Reset
                                </a>
                            </form>

                            {{-- TOMBOL CETAK PDF --}}
                            <a href="{{ route('teacher.data-ppdb.cetak-pdf', request()->query()) }}"
                                target="_blank"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cetak Data (PDF)
                            </a>
                        </div>
                    </div>
                    {{-- - AKHIR KONTROL FILTER & CETAK PDF - --}}


                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full divide-y divide-gray-200 table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No.</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">
                                        Foto</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Formulir</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                        Nama Siswa</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tingkat</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($formulirPpdb as $index => $formulir)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                                            {{ $index + 1 }}</td>

                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-700 text-center">
                                            <img src="{{ $formulir->foto_url }}" alt="Foto Siswa"
                                                class="w-10 h-10 rounded-full object-cover mx-auto border border-gray-300">
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-left">
                                            {{ $formulir->no_form ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                            {{ $formulir->nama_pd ?? 'N/A' }}
                                            <div class="text-xs text-gray-500 mt-1">
                                                Lahir: {{ $formulir->tlahir ?? 'N/A' }},
                                                {{ $formulir->tgllahir ? \Carbon\Carbon::parse($formulir->tgllahir)->format('d M Y') : 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                                            {{ $formulir->tingkat->tingkat ?? 'N/A' }}
                                        </td>

                                        {{-- KOLOM STATUS PPDB --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($formulir->status_id == 1) bg-green-100 text-green-800
                                                @elseif($formulir->status_id == 2) bg-yellow-100 text-yellow-800
                                                @elseif($formulir->status_id == 3) bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $formulir->status->status ?? 'N/A' }}
                                            </span>
                                        </td>

                                        {{-- KOLOM AKSI (Edit dan Hapus) --}}
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center flex items-center justify-center space-x-3 w-40">
                                            <a href="{{ route('teacher.data-ppdb.edit', ['formulir' => $formulir->no_form]) }}"
                                                class="text-white bg-blue-500 hover:bg-blue-600 transition duration-150 py-1.5 px-3 rounded-lg shadow-md font-bold text-xs transform hover:scale-105">
                                                Edit
                                            </a>

                                            {{-- <form
                                                action="{{ route('teacher.data-ppdb.destroy', ['formulir' => $formulir->no_form]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data formulir PPDB ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-500 hover:bg-red-600 transition duration-150 py-1.5 px-3 rounded-lg shadow-md font-bold text-xs transform hover:scale-105">
                                                    Hapus
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-8 text-center text-gray-500 text-lg bg-gray-50">
                                            Tidak ada data formulir PPDB yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SCRIPT JAVASCRIPT UNTUK SUBMIT OTOMATIS --}}
    <script>
        document.getElementById('tingkat-filter').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

        document.getElementById('status-filter').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>
    @extends('templates.footer')
</body>

</html>