<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SIMDIKMM</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    {{-- STYLING BARU UNTUK HERO AREA --}}
    <style>
        /* Gaya tambahan untuk menyesuaikan tampilan hero area */
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 80px 20px;
            min-height: calc(100vh - 120px);
        }

        .header {
            display: flex;
            justify-content: space-between; /* Pisahkan Logo+Teks (header-left) dan Login */
            align-items: center; /* Sejajarkan vertikal */
            padding: 10px 5%; 
            background-color: white; /* Contoh warna latar */
        }

        .header-left {
            display: flex;
            align-items: center; /* Sejajarkan logo dan school-info di tengah vertikal */
        }

.logo {
    /* Menghapus atau menimpa properti max-height yang mungkin mengecilkan logo */
    max-height: none !important; 
    
    /* Tentukan ukuran baru yang lebih besar, misalnya 80 piksel */
    height: 80px; 
    width: auto; /* Memastikan lebar menyesuaikan agar gambar tidak terdistorsi */
}

        .hero-area {
            /* Gaya background untuk gambar dari admin */
            background-color: rgba(0, 100, 200, 0.9);
            background-size: cover;
            /* Gambar menutupi area */
            background-position: center;
            background-repeat: no-repeat;

            padding: 50px 30px;
            text-align: center;
            color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 700px;
            width: 100%;
        }

        .hero-area-fallback {
            /* Warna fallback jika tidak ada gambar admin */
            background-color: rgba(0, 100, 200, 0.9);
        }

        /* ... (Gaya-gaya lainnya tetap sama) ... */
        .hero-text {
            font-size: clamp(30px, 5vw, 48px);
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .countdown-label {
            font-size: clamp(16px, 2.5vw, 20px);
            font-weight: 600;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 15px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 20px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            background-color: #218838;
        }

        .cta-button:disabled {
            background-color: #808080 !important;
            cursor: not-allowed;
            pointer-events: none;
        }

        .banner-section {
            background-color: none;
            padding: 50px 20px;
            text-align: center;
        }

        @media (max-width: 600px) {
            /* HEADER HP */
            .header {
                padding: 8px 3%;
            }

            .school-info h1 {
                font-size: 0.9em;
                display: none;
            }
            
			.logo {
                height: 20px; /* Tetap kecil di HP */
            }

            .school-info p {
                font-size: 0.65em;
                display: none;
            }

            .footer {
                font-size: 0.6em;
            }
            
            .login-button {
                padding: 8px 15px;
                font-size: 0.8em;
            }

            /* HERO AREA HP */
            .main-content {
                padding: 50px 10px;
                min-height: 90vh;
            }
            
            .hero-area {
                padding: 30px 15px;
                width: 95%; 
            }

            .hero-text {
                font-size: clamp(24px, 7vw, 36px); 
                margin-bottom: 5px;
            }

            .countdown-label {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .cta-button {
                padding: 12px 30px; 
                font-size: 18px;
            }
        }
        
    </style>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>

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

    <main class="main-content">

        @php
            $heroStyle = 'style="';
            $heroClass = 'hero-area';

            if (!empty($fotoHomepageUrl) && $fotoHomepageUrl !== asset('img/smm.jpg')) {
                // Hapus kelas fallback jika menggunakan gambar custom
                $heroClass = 'hero-area';
                $heroStyle .=
                    'background-image: linear-gradient(rgba(24, 56, 66, 0.4), rgba(38, 70, 92, 0.4)), url(\'' .
                    $fotoHomepageUrl .
                    '\'); background-color: transparent; 
    background-size: cover;
    background-position: center;';
            } else {
                // Gunakan warna solid biru jika tidak ada gambar admin
                $heroStyle .= 'background-color: rgba(0, 100, 200, 0.9);';
            }
            $heroStyle .= '"';
        @endphp

        @if ($activeGelombang && $activeGelombang->tgl_tutup->isFuture())
            <div class="{{ $heroClass }}" {!! $heroStyle !!}>
                <div class="hero-text">
                    SPMB
                    <br>
                    {{ strtoupper($activeGelombang->nama_gelombang) }} DIBUKA!
                </div>
                <p class="countdown-label" id="countdown-display">
                    (Sisa waktu pendaftaran: Menghitung...)
                </p>

                <a href="{{ url('/formulir') }}" class="cta-button" id="cta-button">Daftar Sekarang</a>

            </div>
        @else
            <div class="hero-area" style="background-color: rgba(100, 100, 100, 0.9);">
                <div class="hero-text">
                    SPMB
                    <br>
                    BELUM DIBUKA
                </div>
                <p class="countdown-label">
                    (Informasi pendaftaran akan segera diumumkan)
                </p>

                <button class="cta-button" disabled>Pendaftaran Ditutup</button>
            </div>
        @endif


    </main>

    {{-- <section class="banner-section">
        <div class="banner-content">
            AREA BANNER PROMOSI SEKOLAH & FASILITAS
        </div>
    </section> --}}

    <footer>
        @include('templates.footer')
    </footer>

    @if ($activeGelombang && $activeGelombang->tgl_tutup->isFuture())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Waktu penutupan gelombang
                const countDownDate = new Date("{{ $activeGelombang->tgl_tutup->toDateTimeString() }}").getTime();
                const countdownDisplay = document.getElementById('countdown-display');
                const ctaButton = document.getElementById('cta-button');

                const x = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(x);
                        countdownDisplay.innerHTML = "(Waktu pendaftaran habis!)";

                        // Menonaktifkan tombol
                        ctaButton.style.backgroundColor = '#808080';
                        ctaButton.style.cursor = 'not-allowed';
                        ctaButton.innerText = 'Pendaftaran Ditutup';
                        ctaButton.setAttribute('disabled', 'true');
                        ctaButton.setAttribute('href', '#');
                        return;
                    }

                    // Kalkulasi waktu (D Hari, H Jam, M Menit, S Detik)
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                    // Membuat string tampilan
                    let countdownString = `(Sisa waktu pendaftaran: `;
                    if (days > 0) {
                        countdownString += `${days} Hari `;
                    }
                    countdownString += `${String(hours).padStart(2, '0')} Jam `;
                    countdownString += `${String(minutes).padStart(2, '0')} Menit`;
                    countdownString += `)`;

                    countdownDisplay.innerHTML = countdownString;
                }, 1000);
            });
        </script>
    @endif
</body>

</html>
