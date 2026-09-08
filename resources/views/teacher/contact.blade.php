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
        /* ======================================= */
        /* CSS DEFAULT (Desktop) & Base Layout */
        /* ======================================= */
        
        /* HEADER BASE (Diasumsikan sudah ada di template atau di-include) */
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

        /* CARD LAYOUT BASE */
        .stat-card-main {
            padding: 40px; /* Padding default yang besar */
        }
        
        .stat-card-total-ppdb {
            padding: 20px;
        }

        .stat-card-mini {
            padding: 15px;
        }

        /* ======================================= */
        /* MEDIA QUERY KHUSUS HP (Max 768px) */
        /* ======================================= */
        @media (max-width: 768px) {
            
            /* HEADER HP (Dari perbaikan sebelumnya) */
            .header {
                padding: 8px 3%;
            }

            .logo {
                height: 35px; 
                margin-right: 5px;
            }
            
            /* WELCOME CARD */
            .py-10.bg-cover.bg-center {
                padding-top: 5px !important;
                padding-bottom: 5px !important;
            }

            /* STATISTIC CARDS */
            
            /* Kunci perbaikan: Menghilangkan grid 2 kolom di HP untuk Card 2 */
            .col-span-1.flex.flex-col.gap-3 {
                 /* Memastikan kolom kedua yang berisi sub-card mengambil lebar penuh */
                 width: 100%;
            }

            /* Kunci perbaikan: Mengubah tata letak grid 4 sub-card menjadi tumpukan */
            .grid.grid-cols-1.md\:grid-cols-2.gap-3.flex-grow {
                display: flex; /* Override grid untuk Flex */
                flex-direction: column; /* Tumpuk semua sub-card */
                gap: 15px;
            }

            /* Kunci perbaikan: Mengurangi Padding di semua Card */
            .stat-card-main {
                padding: 25px; 
            }
            .stat-card-main p.text-4xl {
                font-size: 3rem !important; /* Angka agak dikecilkan */
            }
            .stat-card-main p.text-xl {
                font-size: 1rem !important; /* Deskripsi dikecilkan */
            }

            .stat-card-total-ppdb {
                padding: 15px;
            }

            /* Mini Cards */
            .stat-card-mini {
                padding: 15px;
            }
            .stat-card-mini p.text-3xl {
                font-size: 2rem !important; /* Angka pada mini card dikecilkan */
            }
            .stat-card-mini p.text-sm {
                font-size: 0.8rem !important; /* Deskripsi pada mini card dikecilkan */
            }
            
                    @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
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
                        <x-nav-link :href="route('teacher.contact')" :active="request()->routeIs('teacher.contact')">
                            {{ __('Contact') }}
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
                <x-responsive-nav-link :href="route('teacher.contact')" :active="request()->routeIs('teacher.contact')">
                    {{ __('Contact') }}
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
                {{-- Tombol Login --}}
            </button>
        </header>
    </x-slot>

    <div style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">


    <x-slot name="header">
        <div style="margin-bottom: 40px;">
            {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2> --}}
        </div>
    </x-slot>

    <div style="min-height: 85vh; margin-bottom: 40px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="py-12 bg-cover bg-center">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __('Welcome Back, ') }}<span class="font-semibold">{{ Auth::user()->username }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @extends('templates.footer')
</body>

</html>
