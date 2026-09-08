<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased"
    style="min-height: 100vh;
    background-image: url('{{ asset('img/smm.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <div>
        @include('layouts.navigation')

        <!--
        Blok header lama (@if (isset($header))
...
@endif) telah dihapus
        untuk menghindari garis ganda di bawah navbar dan memastikan tata letak bersih.
        -->

        <main class="pt-16">
            {{ $slot }}
        </main>
    </div>
@stack('scripts')
    <script>
        function updateTime() {
            const now = new Date();

            // 1. Opsi untuk format TANGGAL (misal: Friday, October 17, 2025)
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            // 2. Opsi untuk format JAM (misal: 10:56:00)
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false // Format 24 jam
            };

            // Dapatkan format tanggal dan waktu secara terpisah (menggunakan 'en-US' untuk format bahasa Inggris yang Anda inginkan)
            const formattedDate = now.toLocaleDateString('en-US', dateOptions);
            const formattedTime = now.toLocaleTimeString('en-US', timeOptions);

            // GABUNGKAN dengan <br> dan gunakan .innerHTML untuk membuat line break (dua baris)
            const htmlContent = formattedDate + '<br>' + formattedTime;

            // Tampilkan di placeholder ('current-time' di navigation.blade.php)
            // Cek dulu apakah elemen ada, karena skrip ini berjalan di semua halaman
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.innerHTML = htmlContent;
            }
        }

        // Panggil fungsi segera dan atur interval untuk update setiap detik
        updateTime();
        setInterval(updateTime, 1000);
    </script>


    @extends('templates.footer')
</body>

</html>
