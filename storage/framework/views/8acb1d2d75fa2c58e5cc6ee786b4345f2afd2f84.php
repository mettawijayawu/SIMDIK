<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo.png')); ?>">


    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased"
    style="min-height: 100vh;
    background-image: url('<?php echo e(asset('img/smm.jpg')); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <div>
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--
        Blok header lama (<?php if(isset($header)): ?>
...
<?php endif; ?>) telah dihapus
        untuk menghindari garis ganda di bawah navbar dan memastikan tata letak bersih.
        -->

        <main class="pt-16">
            <?php echo e($slot); ?>

        </main>
    </div>
<?php echo $__env->yieldPushContent('scripts'); ?>
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


    
</body>

</html>

<?php echo $__env->make('templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/layouts/app.blade.php ENDPATH**/ ?>