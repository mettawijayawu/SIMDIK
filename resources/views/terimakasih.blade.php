<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - SIMDIKMM</title>

    {{-- Pengalihan (Redirect) Otomatis setelah 5 detik ke halaman login (diasumsikan route('login') atau url('/login')) --}}
    <meta http-equiv="refresh" content="5;url={{ route('login') ?? url('/login') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
        <style>

        @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
        }
        
    </style>
<body
    style="min-height: 100vh;
    background-image: url('{{ asset('img/smm.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <footer>
        @include('templates.header')
    </footer>
    <div class="main-content" style= "margin-top: 56px; margin-bottom: 160px;">
        <div class="hero-area-trimis">
            <div class="hero-text-trimis">
                <h1>Terima Kasih Telah Mendaftar! 🎉</h1>
                <p>Data Anda telah berhasil kami terima.</p>
                <p class="countdown">Anda akan diarahkan kembali dalam waktu <span id="timer">5</span>
                    detik...
                </p>
                <p>Jika tidak teralihkan, silakan klik <a href="{{ route('login') ?? url('/login') }}">di sini</a>.</p>
            </div>
        </div>
    </div>
    <footer>
        @include('templates.footer')
    </footer>


    {{-- SCRIPT OPSIONAL: Untuk menampilkan hitungan mundur yang lebih interaktif --}}
    <script>
        let count = 5;
        const timerElement = document.getElementById('timer');

        function countdown() {
            count--;
            if (timerElement) {
                timerElement.textContent = count;
            }
            if (count === 0) {
                // Di sini Anda bisa menambahkan window.location.href jika meta refresh tidak bekerja
                // window.location.href = "{{ route('login') ?? url('/login') }}";
                clearInterval(interval);
            }
        }

        const interval = setInterval(countdown, 1000);
    </script>
</body>

</html>
