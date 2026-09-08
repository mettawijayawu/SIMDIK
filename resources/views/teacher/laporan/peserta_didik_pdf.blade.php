<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peserta Didik</title>

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
            /* Menyetarakan konten di tengah vertikal */
        }

        .header-logo {
            width: 10%;
            /* Logo mengambil 10% lebar kolom */
            text-align: left;
            padding-right: 10px;
        }

        .header-text {
            width: 90%;
            /* Teks mengambil 90% lebar kolom */
        }

        .header-text h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }

        .header-text p {
            margin: 0;
            font-size: 11px;
            /* Ukuran font alamat diperbesar */
            line-height: 1.4;
        }

        /* UKURAN LOGO */
        .logo-img {
            max-width: 50px;
            /* Ukuran maksimal logo dikecilkan */
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
            /* Ruang lebih besar di bawah tabel */
        }

        th,
        td {
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

        /* Area TTD yang diposisikan ke kanan */
        .ttd-area {
            width: 40%;
            text-align: center;
            margin-left: auto;
        }

        .ttd-spacer {
            height: 60px;
            /* Ruang lebih besar untuk tanda tangan */
            display: block;
        }

        /* Footer teks cetak (Diposisikan tetap di bawah) */
        .footer-print {
            position: fixed;
            bottom: 0;
            left: 0;
            font-size: 8px;
            padding: 10px 0;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-col header-logo">
            {{-- GANTI DENGAN public_path() JIKA URL ONLINE BERMASALAH --}}
            <img src="https://www.dbl.id/uploads/school/48797/993-SMK_METTA_MAITREYA.png" class="logo-img"
                alt="Logo Sekolah">
        </div>
        <div class="header-col header-text">
            <h3>METTA MAITREYA SCHOOL</h3>
            <p>PAUD - SD - SMP - SMK</p>
            <p>Jl. Tuanku Tambusai, Kompleks Puri Nangka Sari, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28282</p>
        </div>
    </div>

    <h2>LAPORAN DATA PESERTA DIDIK</h2>

    <p class="filter-info">
        Filter: {{ $filterTitle }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 15%;">NIS/NISN</th>
                <th style="width: 25%;">Nama Peserta Didik</th>
                <th style="width: 10%;">Tingkat</th>
                <th style="width: 10%;">Tahun Masuk</th>
                <th style="width: 20%;">Tempat/Tgl Lahir</th>
                <th style="width: 15%;">No. HP Ortu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesertaDidik as $index => $siswa)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $siswa->nis ?? '-' }} / {{ $siswa->nisn ?? '-' }}</td>
                    <td>{{ $siswa->formulir->nama_pd ?? 'Nama tidak ditemukan' }}</td>
                    <td>{{ $siswa->tingkat->tingkat ?? '-' }}</td>
                    <td>{{ $siswa->tahunMasuk->thnmasuk ?? '-' }}</td>
                    <td>{{ $siswa->formulir->tlahir ?? '-' }},
                        {{ \Carbon\Carbon::parse($siswa->formulir->tgllahir ?? now())->format('d-m-Y') }}</td>
                    <td>{{ $siswa->formulir->notelportu ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data peserta didik yang sesuai dengan
                        filter.</td>
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
                {{-- Anda bisa menambahkan jabatan di sini (misal: Kepala Sekolah) --}}
            </p>

            <span class="ttd-spacer"></span>

            <p
                style="margin-top: 5px; font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 2px; display: inline-block; min-width: 150px;">
                Nama Guru
            </p>
        </div>
    </div>

    {{-- Footer Cetak --}}
    <p class="footer-print">
        Dicetak oleh SIMDIK-MM pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
    </p>

</body>

</html>
