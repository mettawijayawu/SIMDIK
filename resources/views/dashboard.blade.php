<x-app-layout>

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
    </x-slot>

    {{-- KODE TAMBAHAN: MEMUAT FONT AWESOME UNTUK MEMASTIKAN ICON MUNCUL --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJc5Dk7I6rW6T2z0P9r8Y5T6v3L9l2Fm4g3W3w5l05L09qKj6O9l5t1J5u7F+Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div style="min-height: 85vh;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Welcome Card (DIBIARKAN SAMA) --}}
            <div class="py-1 bg-cover bg-center">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __('Welcome Back, ') }}<span class="font-semibold">{{ Auth::user()->username }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- START: STATUS PPDB CARD --}}
            <div class="py-5 bg-cover bg-center">
                <div
                    class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg mb-6">

                    {{-- HEADER DAN TOMBOL DALAM CONTAINER TERPISAH --}}
                    <div class="p-6 center-content">
                        <h2 class="text-2xl font-bold text-gray-800" style="margin-bottom: 10px;">
                            Daftar Formulir yang Diajukan
                        </h2>
                        {{-- TOMBOL DI BAWAH JUDUL --}}
                        <a href="{{ route('formulir.create') }}" class="tambah-button">
                            Tambah Formulir
                        </a>
                    </div>

                    {{-- FORMULIR LIST START (Dibungkus p-6 untuk padding) --}}
                    <div class="p-6 pt-0">
                        {{-- Cek apakah ada data formulir --}}
                        @forelse ($formulirs as $formulir)
                            {{-- KOREKSI KRITIS: MEMBUNGKUS SELURUH KARTU DENGAN TAG <a> --}}
                            {{-- Target: formulir.edit, Parameter: ID Formulir --}}
                            <a href="{{ route('formulir.edit', $formulir->no_form) }}"
                                class="block no-underline mb-6 hover:shadow-xl transition-shadow duration-300 text-gray-900">
                                {{-- Ambil status label dan tanggal --}}
                                @php
                                    $statusLabel = $formulir->status->status ?? 'Tidak Diketahui';
                                    $tanggalPengajuan = $formulir->created_at->translatedFormat('d F Y');
                                    $tanggalKeputusan = $formulir->updated_at->translatedFormat('d F Y');
                                    // Ambil catatan admin dari kolom 'note'
                                    $adminNote = $formulir->note; 
                                    $keteranganDefault =
                                        'Dokumen Anda sedang dalam proses verifikasi oleh panitia PPDB. Mohon tunggu informasi lebih lanjut.';

                                    // Logika untuk menentukan skema warna dan ikon menggunakan kelas literal
                                    switch ($statusLabel) {
                                        case 'Diterima':
                                            $bg_class_main = 'bg-green-600';
                                            $bg_class_light = 'bg-green-50';
                                            $border_class = 'border-green-600';
                                            $text_class_heading = 'text-green-700';
                                            $icon_class = 'fa-solid fa-circle-check';
                                            $message_heading = 'SELAMAT! DITERIMA';
                                            $keterangan =
                                                'Pendaftaran anak Anda telah disetujui. Silakan lanjutkan ke tahap pendaftaran ulang.';
                                            break;
                                        case 'Ditolak':
                                            $bg_class_main = 'bg-red-600';
                                            $bg_class_light = 'bg-red-50';
                                            $border_class = 'border-red-600';
                                            $text_class_heading = 'text-red-700';
                                            $icon_class = 'fa-solid fa-circle-xmark';
                                            $message_heading = 'MOHON MAAF, DITOLAK';
                                            $keterangan =
                                                'Pendaftaran anak Anda belum memenuhi syarat. Mohon hubungi panitia untuk informasi lebih lanjut.';
                                            break;
                                        case 'Menunggu Konfirmasi':
                                        default:
                                            $bg_class_main = 'bg-blue-600';
                                            $bg_class_light = 'bg-blue-50';
                                            $border_class = 'border-blue-600';
                                            $text_class_heading = 'text-blue-700';
                                            $icon_class = 'fa-solid fa-hourglass-half';
                                            $message_heading = 'MENUNGGU KONFIRMASI';
                                            $keterangan = $keteranganDefault;
                                            break;
                                    }
                                @endphp

                                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                    <div class="p-6 md:p-8">
                                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                                            {{ $formulir->nama_pd }} (Tingkat:
                                            {{ $formulir->tingkat->tingkat ?? 'N/A' }})
                                        </h3>

                                        {{-- STATUS CARD --}}
                                        <div
                                            class="flex flex-col md:flex-row items-start md:items-center p-6 rounded-xl shadow-xl 
                                            border-l-8 {{ $border_class }} {{ $bg_class_light }}">

                                            {{-- 1. Icon & Status Badge --}}
                                            <div class="flex items-center mb-4 md:mb-0 md:mr-6 w-full md:w-auto">
                                                <div
                                                    class="flex-shrink-0 mr-4 p-3 rounded-full {{ $bg_class_main }} shadow-md flex items-center justify-center">
                                                    {{-- Ikon Font Awesome --}}
                                                    <i class="{{ $icon_class }} text-white text-2xl md:text-3xl"></i>
                                                </div>
                                                <span
                                                    class="inline-flex items-center rounded-full {{ $bg_class_main }} px-4 py-1.5 
                                                    text-sm font-semibold text-white shadow-lg uppercase tracking-wider">
                                                    {{ $statusLabel }}
                                                </span>
                                            </div>

                                            {{-- 2. Content Detail --}}
                                            <div
                                                class="flex-grow mt-4 md:mt-0 border-t md:border-t-0 md:pl-6 pt-4 md:pt-0 border-gray-200">
                                                <p class="text-sm text-gray-500 mb-1">
                                                    No. Formulir: <span
                                                        class="font-bold text-gray-800">{{ $formulir->no_form }}</span>
                                                </p>

                                                <h4 class="text-xl font-extrabold {{ $text_class_heading }} mb-2">
                                                    {{ $message_heading }}
                                                </h4>

                                                <p class="text-gray-600 text-sm italic">{{ $keterangan }}</p>
                                            </div>
                                        </div>

                                        {{-- FOOTER DETAIL --}}
                                        <div class="mt-6 text-sm text-gray-600 border-t pt-4">
                                            <p>Tgl. Pengajuan: <span
                                                    class="font-medium text-gray-800">{{ $tanggalPengajuan }}</span>
                                            </p>

                                            @if ($statusLabel != 'Menunggu Konfirmasi')
                                                <p>Tgl. Keputusan: <span
                                                        class="font-medium text-gray-800">{{ $tanggalKeputusan }}</span>
                                                </p>
                                            @endif
                                            
                                            {{-- START: Tambahkan Catatan (noted) jika ada --}}
                                            @if (!empty($adminNote))
                                                <div class="mt-4 p-3 bg-gray-100 border border-gray-300 rounded-lg">
                                                    <p class="font-semibold text-gray-800">Catatan:</p>
                                                    <p class="text-gray-700 whitespace-pre-line">{{ $adminNote }}</p>
                                                </div>
                                            @endif
                                            {{-- END: Tambahkan Catatan (noted) jika ada --}}


                                            @if ($statusLabel == 'Diterima')
                                                <div class="mt-4 p-3 bg-green-100 border border-green-300 rounded-lg">
                                                    <p class="font-semibold text-green-800">Langkah Selanjutnya:</p>
                                                    <p class="text-green-700">Silakan cek detail Pembayaran untuk
                                                        pendaftaran
                                                        ulang.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a> {{-- AKHIR TAG <a> --}}

                        @empty
                            {{-- Pesan jika tidak ada formulir --}}
                            <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-lg shadow-md mb-6">
                                <p class="font-semibold text-yellow-800">Anda belum mengajukan formulir pendaftaran
                                    apapun.
                                </p>
                                <p class="text-yellow-700 mt-1">Gunakan tombol **Tambah Formulir** di atas untuk memulai
                                    pendaftaran.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- END: STATUS PPDB CARD --}}

        </div>

    </div>
</x-app-layout>