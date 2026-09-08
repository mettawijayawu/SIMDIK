<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data PPDB</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        /* Mengatur font dan ukuran dasar */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
        }

        /* --- STYLING HEADER (Kop Surat) --- */
        .header {
            display: table;
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header-col {
            display: table-cell;
            vertical-align: middle;
        }

        .header-logo {
            width: 10%;
            text-align: left;
            padding-right: 10px;
        }

        .header-text {
            width: 90%;
        }

        .header-text h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }

        .header-text p {
            margin: 0;
            font-size: 11px;
            line-height: 1.4;
        }

        .logo-img {
            max-width: 50px;
            height: auto;
        }

        /* --- STYLING JUDUL DAN FILTER --- */
        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .filter-info {
            margin-bottom: 15px;
            font-size: 11px;
            font-weight: bold;
        }

        /* --- STYLING TABEL DATA --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 80px;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        /* --- STYLING TANDA TANGAN (TTD) --- */
        .ttd-container {
            width: 100%;
            margin-top: 50px;
        }

        .ttd-area {
            width: 40%;
            text-align: center;
            margin-left: auto;
        }

        .ttd-spacer {
            height: 60px;
            display: block;
        }

        /* Footer teks cetak */
        .footer-print {
            position: fixed;
            bottom: 0;
            left: 0;
            font-size: 8px;
            padding: 10px 0;
        }

        /* Status colors for PDF */
        .status-text {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-col header-logo">
            <img src="https://www.dbl.id/uploads/school/48797/993-SMK_METTA_MAITREYA.png" class="logo-img" alt="Logo Sekolah">
        </div>
        <div class="header-col header-text">
            <h3>METTA MAITREYA SCHOOL</h3>
            <p>PAUD - SD - SMP - SMK</p>
            <p>Jl. Tuanku Tambusai, Kompleks Puri Nangka Sari, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28282</p>
        </div>
    </div>

    <h2>LAPORAN DATA FORMULIR PPDB</h2>

    <p class="filter-info">
        Filter: {{ $filterTitle ?? 'Semua Data' }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 15%;">No. Formulir</th>
                <th style="width: 25%;">Nama Peserta Didik</th>
                <th style="width: 15%;">Tingkat</th>
                <th style="width: 20%;">Tempat/Tgl Lahir</th>
                <th style="width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ppdb as $index => $formulir)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $formulir->no_form ?? '-' }}</td>
                    <td>{{ $formulir->nama_pd ?? 'Nama tidak ditemukan' }}</td>
                    <td style="text-align: center;">{{ $formulir->tingkat->tingkat ?? '-' }}</td>
                    <td>
                        {{ $formulir->tlahir ?? '-' }}, 
                        {{ $formulir->tgllahir ? \Carbon\Carbon::parse($formulir->tgllahir)->format('d-m-Y') : '-' }}
                    </td>
                    <td style="text-align: center;">
                        <span class="status-text">
                            {{ $formulir->status->status ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data formulir PPDB yang sesuai dengan filter.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-area">
            <p style="margin-bottom: 5px;">
                Pekanbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
            <p style="margin-bottom: 5px; font-weight: bold;">
                Panitia PPDB
            </p>

            <span class="ttd-spacer"></span>

            <p style="margin-top: 5px; font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 2px; display: inline-block; min-width: 150px;">
                {{ Auth::user()->name }}
            </p>
        </div>
    </div>

    <p class="footer-print">
        Dicetak oleh SIMDIK-MM pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
    </p>

</body>
</html>