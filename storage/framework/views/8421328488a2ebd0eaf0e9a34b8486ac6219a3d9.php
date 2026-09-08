<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <style>

        @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
        }
        
    </style>
     <?php $__env->slot('header', null, []); ?> 
        <div style="margin-bottom: 40px;">
            
        </div>
     <?php $__env->endSlot(); ?>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJc5Dk7I6rW6T2z0P9r8Y5T6v3L9l2Fm4g3W3w5l05L09qKj6O9l5t1J5u7F+Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div style="min-height: 85vh;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="py-1 bg-cover bg-center">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <?php echo e(__('Welcome Back, ')); ?><span class="font-semibold"><?php echo e(Auth::user()->username); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="py-5 bg-cover bg-center">
                <div
                    class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg mb-6">

                    
                    <div class="p-6 center-content">
                        <h2 class="text-2xl font-bold text-gray-800" style="margin-bottom: 10px;">
                            Daftar Formulir yang Diajukan
                        </h2>
                        
                        <a href="<?php echo e(route('formulir.create')); ?>" class="tambah-button">
                            Tambah Formulir
                        </a>
                    </div>

                    
                    <div class="p-6 pt-0">
                        
                        <?php $__empty_1 = true; $__currentLoopData = $formulirs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formulir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            
                            
                            <a href="<?php echo e(route('formulir.edit', $formulir->no_form)); ?>"
                                class="block no-underline mb-6 hover:shadow-xl transition-shadow duration-300 text-gray-900">
                                
                                <?php
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
                                ?>

                                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                    <div class="p-6 md:p-8">
                                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                                            <?php echo e($formulir->nama_pd); ?> (Tingkat:
                                            <?php echo e($formulir->tingkat->tingkat ?? 'N/A'); ?>)
                                        </h3>

                                        
                                        <div
                                            class="flex flex-col md:flex-row items-start md:items-center p-6 rounded-xl shadow-xl 
                                            border-l-8 <?php echo e($border_class); ?> <?php echo e($bg_class_light); ?>">

                                            
                                            <div class="flex items-center mb-4 md:mb-0 md:mr-6 w-full md:w-auto">
                                                <div
                                                    class="flex-shrink-0 mr-4 p-3 rounded-full <?php echo e($bg_class_main); ?> shadow-md flex items-center justify-center">
                                                    
                                                    <i class="<?php echo e($icon_class); ?> text-white text-2xl md:text-3xl"></i>
                                                </div>
                                                <span
                                                    class="inline-flex items-center rounded-full <?php echo e($bg_class_main); ?> px-4 py-1.5 
                                                    text-sm font-semibold text-white shadow-lg uppercase tracking-wider">
                                                    <?php echo e($statusLabel); ?>

                                                </span>
                                            </div>

                                            
                                            <div
                                                class="flex-grow mt-4 md:mt-0 border-t md:border-t-0 md:pl-6 pt-4 md:pt-0 border-gray-200">
                                                <p class="text-sm text-gray-500 mb-1">
                                                    No. Formulir: <span
                                                        class="font-bold text-gray-800"><?php echo e($formulir->no_form); ?></span>
                                                </p>

                                                <h4 class="text-xl font-extrabold <?php echo e($text_class_heading); ?> mb-2">
                                                    <?php echo e($message_heading); ?>

                                                </h4>

                                                <p class="text-gray-600 text-sm italic"><?php echo e($keterangan); ?></p>
                                            </div>
                                        </div>

                                        
                                        <div class="mt-6 text-sm text-gray-600 border-t pt-4">
                                            <p>Tgl. Pengajuan: <span
                                                    class="font-medium text-gray-800"><?php echo e($tanggalPengajuan); ?></span>
                                            </p>

                                            <?php if($statusLabel != 'Menunggu Konfirmasi'): ?>
                                                <p>Tgl. Keputusan: <span
                                                        class="font-medium text-gray-800"><?php echo e($tanggalKeputusan); ?></span>
                                                </p>
                                            <?php endif; ?>
                                            
                                            
                                            <?php if(!empty($adminNote)): ?>
                                                <div class="mt-4 p-3 bg-gray-100 border border-gray-300 rounded-lg">
                                                    <p class="font-semibold text-gray-800">Catatan:</p>
                                                    <p class="text-gray-700 whitespace-pre-line"><?php echo e($adminNote); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            


                                            <?php if($statusLabel == 'Diterima'): ?>
                                                <div class="mt-4 p-3 bg-green-100 border border-green-300 rounded-lg">
                                                    <p class="font-semibold text-green-800">Langkah Selanjutnya:</p>
                                                    <p class="text-green-700">Silakan cek detail Pembayaran untuk
                                                        pendaftaran
                                                        ulang.</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a> 

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            
                            <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-lg shadow-md mb-6">
                                <p class="font-semibold text-yellow-800">Anda belum mengajukan formulir pendaftaran
                                    apapun.
                                </p>
                                <p class="text-yellow-700 mt-1">Gunakan tombol **Tambah Formulir** di atas untuk memulai
                                    pendaftaran.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/dashboard.blade.php ENDPATH**/ ?>