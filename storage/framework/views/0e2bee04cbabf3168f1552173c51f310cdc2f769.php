<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div style="margin-bottom: 40px;">
            
        </div>
     <?php $__env->endSlot(); ?>

    <div style="min-height: 85vh;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" style="min-height: 80vh;">

            
            <div class="py-10 bg-cover bg-center" style="margin-top: 20px;">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <?php echo e(__('Welcome Back, ')); ?><span class="font-semibold"><?php echo e(Auth::user()->username); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-2xl shadow-gray-700/50 sm:rounded-lg">

                <div class="p-6">
                    
                    <div class="mb-6 mt-6">
                        
                        <h3 class="text-lg font-semibold mb-3">Filter Data Peserta Didik</h3>

                        <div class="flex justify-between items-center">
                            
                            
                            <form id="filter-form" action="<?php echo e(route('admin.data-peserta-didik')); ?>" method="GET"
                                class="flex items-center space-x-3">

                                
                                <h1 style="margin-right: 20px;">Tingkat:</h1>
                                <select name="tingkat_filter" id="tingkat-filter" style="margin-right: 20px;"
                                    class="py-2 px-5 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mr-5 w-40">
                                    
                                    <option value="" <?php if(request('tingkat_filter') == ''): echo 'selected'; endif; ?>>All</option>
                                    <?php $__currentLoopData = $tingkatList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tingkat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tingkat->id); ?>" <?php if(request('tingkat_filter') == $tingkat->id): echo 'selected'; endif; ?>>
                                            <?php echo e($tingkat->tingkat); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                

                                <h1 style="margin-right: 20px;">Tahun Masuk:</h1>
                                <select name="tahun_masuk_filter" id="tahun-masuk-filter" style="margin-right: 20px;"
                                    class="py-2 px-5 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-40">
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $tahunMasukList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tahun->id); ?>" <?php if(request('tahun_masuk_filter') == $tahun->id): echo 'selected'; endif; ?>>
                                            <?php echo e($tahun->thnmasuk); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                
                            </form>

                            
                            <a href="<?php echo e(route('admin.data-peserta-didik.cetak-pdf', request()->query())); ?>"
                                target="_blank"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cetak Data (PDF)
                            </a>
                        </div>
                    </div>
                    


                    
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                            role="alert">
                            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>

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
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NIS / NISN</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Siswa</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tingkat</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tahun Masuk</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                <?php $__empty_1 = true; $__currentLoopData = $pesertaDidik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                                            <?php echo e($index + 1); ?></td>

                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-700 text-center">
                                            
                                            <img src="<?php echo e($siswa->foto_url ?? '/images/default_avatar.png'); ?>"
                                                alt="Foto Siswa"
                                                class="w-10 h-10 rounded-full object-cover mx-auto border border-gray-300">
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                            <?php echo e($siswa->nis ?? 'N/A'); ?> / <?php echo e($siswa->nisn ?? 'N/A'); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                            <?php echo e($siswa->formulir->nama_pd ?? 'Data Formulir Hilang'); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                                            
                                            <?php echo e($siswa->tingkat->tingkat ?? 'N/A'); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                                            
                                            <?php echo e($siswa->tahunMasuk->thnmasuk ?? 'N/A'); ?>

                                        </td>

                                        
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center flex items-center justify-center space-x-3 w-40">
                                            <a href="<?php echo e(route('admin.data-peserta-didik.edit', $siswa->id)); ?>"
                                                class="text-white bg-blue-500 hover:bg-blue-600 transition duration-150 py-1.5 px-3 rounded-lg shadow-md font-bold text-xs transform hover:scale-105">
                                                Edit
                                            </a>

                                            
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-8 text-center text-gray-500 text-lg bg-gray-50">
                                            Tidak ada Peserta Didik yang terdaftar saat ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    
    <script>
        document.getElementById('tingkat-filter').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

        document.getElementById('tahun-masuk-filter').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/admin/data-peserta-didik.blade.php ENDPATH**/ ?>