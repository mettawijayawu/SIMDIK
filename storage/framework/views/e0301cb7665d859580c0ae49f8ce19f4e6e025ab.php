<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>
    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    
    
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo.png')); ?>">
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
            height: 60px;
            /* Ukuran default desktop */
            width: auto;
            margin-right: 15px;
            flex-shrink: 0;
        }

        /* CARD LAYOUT BASE */
        .stat-card-main {
            padding: 40px;
            /* Padding default yang besar */
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
                display: flex;
                /* Override grid untuk Flex */
                flex-direction: column;
                /* Tumpuk semua sub-card */
                gap: 15px;
            }

            /* Kunci perbaikan: Mengurangi Padding di semua Card */
            .stat-card-main {
                padding: 25px;
            }

            .stat-card-main p.text-4xl {
                font-size: 3rem !important;
                /* Angka agak dikecilkan */
            }

            .stat-card-main p.text-xl {
                font-size: 1rem !important;
                /* Deskripsi dikecilkan */
            }

            .stat-card-total-ppdb {
                padding: 15px;
            }

            /* Mini Cards */
            .stat-card-mini {
                padding: 15px;
            }

            .stat-card-mini p.text-3xl {
                font-size: 2rem !important;
                /* Angka pada mini card dikecilkan */
            }

            .stat-card-mini p.text-sm {
                font-size: 0.8rem !important;
                /* Deskripsi pada mini card dikecilkan */
            }

        }
    </style>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

</head>

<body class="font-sans antialiased bg-gray-100" class="font-sans antialiased"
    style="min-height: 70vh;
    background-image: url('<?php echo e(asset('img/smm.jpg')); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;">

    <nav x-data="{ open: false }" class="fixed top-0 w-full z-10 bg-white border-b border-white-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        
                        <a href="<?php echo e(route('teacher.dashboard')); ?>"> 
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'block h-7 w-auto fill-current text-gray-800','style' => 'width: 40px; height: auto;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block h-7 w-auto fill-current text-gray-800','style' => 'width: 40px; height: auto;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        
                        
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => ''.e(route('teacher.dashboard')).'','active' => ''.e(request()->routeIs('teacher.dashboard') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.dashboard')).'','active' => ''.e(request()->routeIs('teacher.dashboard') ? 'true' : 'false').'']); ?>
                            <?php echo e(__('Dashboard')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => ''.e(route('teacher.data-peserta-didik')).'','active' => ''.e(request()->routeIs('teacher.datapesertadidik') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.data-peserta-didik')).'','active' => ''.e(request()->routeIs('teacher.datapesertadidik') ? 'true' : 'false').'']); ?>
                            <?php echo e(__('Data Peserta Didik')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => ''.e(route('teacher.data-ppdb')).'','active' => ''.e(request()->routeIs('teacher.datappdb') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.data-ppdb')).'','active' => ''.e(request()->routeIs('teacher.datappdb') ? 'true' : 'false').'']); ?>
                            <?php echo e(__('Data PPDB')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => ''.e(route('teacher.informasi')).'','active' => ''.e(request()->routeIs('teacher.informasi') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.informasi')).'','active' => ''.e(request()->routeIs('teacher.informasi') ? 'true' : 'false').'']); ?>
                            <?php echo e(__('Informasi')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center">

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
                         <?php $__env->slot('trigger', null, []); ?> 
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div><?php echo e(Auth::user()->name); ?></div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                         <?php $__env->endSlot(); ?>

                         <?php $__env->slot('content', null, []); ?> 
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('profile.edit')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.edit')).'']); ?>
                                <?php echo e(__('Profile')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('logout')).'','onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('logout')).'','onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
                                    <?php echo e(__('Log Out')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </form>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">

                
                
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teacher.dashboard')).'','active' => ''.e(request()->routeIs('teacher.dashboard') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.dashboard')).'','active' => ''.e(request()->routeIs('teacher.dashboard') ? 'true' : 'false').'']); ?>
                    <?php echo e(__('Dashboard')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teacher.data-peserta-didik')).'','active' => ''.e(request()->routeIs('teacher.datapesertadidik') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.data-peserta-didik')).'','active' => ''.e(request()->routeIs('teacher.datapesertadidik') ? 'true' : 'false').'']); ?>
                    <?php echo e(__('Data Peserta Didik')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teacher.data-ppdb')).'','active' => ''.e(request()->routeIs('teacher.datappdb') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.data-ppdb')).'','active' => ''.e(request()->routeIs('teacher.datappdb') ? 'true' : 'false').'']); ?>
                    <?php echo e(__('Data PPDB')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teacher.informasi')).'','active' => ''.e(request()->routeIs('teacher.informasi') ? 'true' : 'false').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teacher.informasi')).'','active' => ''.e(request()->routeIs('teacher.informasi') ? 'true' : 'false').'']); ?>
                    <?php echo e(__('Informasi')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200"><?php echo e(Auth::user()->name); ?></div>
                    <div class="font-medium text-sm text-gray-500"><?php echo e(Auth::user()->email); ?></div>
                </div>

                <div class="mt-3 space-y-1">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('profile.edit')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.edit')).'']); ?>
                        <?php echo e(__('Profile')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('logout')).'','onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('logout')).'','onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
                            <?php echo e(__('Log Out')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </nav>
     <?php $__env->slot('header', null, []); ?> 
        <header class="header">
            <div class="header-left">
                <div class="school-info">
                    <a href="/">
                        <img src="https://mettamaitreya.sch.id/assets/images/logo-header.png" alt="Logo Sekolah"
                            class="logo">
                    </a>
                </div>
            </div>
            <button class="login-button">
                <?php if(Route::has('login')): ?>
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard')); ?>"
                                style="color: white;">
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" style="color: white;">Login</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </button>
        </header>
     <?php $__env->endSlot(); ?>

    <div style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
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

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                
                <div class="col-span-1 bg-white shadow-xl rounded-lg flex items-center justify-center stat-card-main">
                    <div class="text-center">
                        <p class="text-4xl font-extrabold text-gray-800" id="stat-students">
                            <?php echo e($totalStudents); ?>

                        </p>
                        <p class="text-xl font-semibold text-gray-500 mt-2">
                            Total Peserta Didik
                        </p>
                    </div>
                </div>

                
                <div class="col-span-1 flex flex-col gap-3">

                    
                    <div
                        class="bg-white shadow-lg rounded-lg flex items-center justify-center stat-card-total-ppdb">
                        <p class="text-xl font-semibold text-gray-800">
                            Total PPDB: <span class="font-extrabold text-blue-600" id="stat-ppdb">
                                <?php echo e($totalPpdb); ?>

                            </span>
                        </p>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 flex-grow">

                        
                        <div
                            class="bg-white shadow-lg rounded-lg flex flex-col items-center justify-center stat-card-mini">
                            <p class="text-3xl font-bold text-green-600" id="stat-accepted"><?php echo e($totalAccepted); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Diterima</p>
                        </div>

                        
                        <div
                            class="bg-white shadow-lg rounded-lg flex flex-col items-center justify-center stat-card-mini">
                            <p class="text-3xl font-bold text-blue-600" id="stat-pending"><?php echo e($totalPending); ?></p>
                            <p class="text-sm text-gray-500 mt-1">Menunggu Konfirmasi</p>
                        </div>

                    </div>

                    
                    <div
                        class="bg-white shadow-lg rounded-lg flex flex-col items-center justify-center stat-card-mini">
                        <p class="text-3xl font-bold text-red-600" id="stat-rejected"><?php echo e($totalRejected); ?></p>
                        <p class="text-sm text-gray-500 mt-1">Ditolak</p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white p-6 shadow-xl rounded-lg">
    
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 border-b pb-4">
        <h3 class="text-2xl font-semibold text-gray-700 mb-2 md:mb-0 flex-grow">
            MONITORING STATUS & POPULASI
        </h3>

        
        <div class="w-full md:w-auto mt-2 md:mt-0">
            <select id="chartSelector" class="border border-gray-300 rounded-md p-2 shadow-sm text-sm w-full md:w-48">
                <option value="ppdb">Status PPDB</option>
                <option value="gender">Peserta Didik per Jenis Kelamin</option>
                <option value="tingkat">Peserta Didik per Tingkat</option>
            </select>
        </div>
    </div>
    
    <div class="relative min-h-[350px] flex items-center justify-center">
        
        <div id="chart-ppdb-container" class="chart-container w-full" style="height: 300px;">
            <canvas id="ppdbChart"></canvas>
        </div>
        
        
        <div id="chart-gender-container" class="chart-container w-full hidden" style="height: 300px;">
            <canvas id="genderChart"></canvas>
        </div>

        
        <div id="chart-tingkat-container" class="chart-container w-full hidden" style="height: 300px;">
            <canvas id="tingkatChart"></canvas>
        </div>
    </div>
</div>

            
            <div class="bg-white p-6 shadow-xl rounded-lg min-h-[350px]">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4 text-center">
                    JUMLAH PESERTA DIDIK PER TAHUN MASUK
                </h3>
                <div class="relative w-full" style="height: 300px;">
                    <canvas id="yearChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    
    <script>
        // 1. **INISIALISASI VARIABEL CHART DAN DATA LOKAL**
        if (typeof Chart === 'undefined') {
            console.error("Chart.js is not loaded. Pastikan CDN script di <head> sudah benar.");
        }

        // Variabel untuk menyimpan instance chart
        const charts = {}; // Menggunakan objek untuk menyimpan semua instance chart
        let latestFetchedData = {};

        // === KODE WARNA CERAH & KONTRAST TINGGI ===
        const COLOR = {
            DITERIMA: '#10B981', // Hijau Cerah
            MENUNGGU: '#3B82F6', // Biru Cerah
            DITOLAK: '#EF4444', // Merah Cerah
            LAKI_LAKI: '#0369A1', // Biru Tua
            PEREMPUAN: '#DB2777', // Pink Tua
            TINGKAT_COLORS: ['#F59E0B', '#10B981', '#3B82F6', '#8B5CF6', '#F472B6', '#14B8A6'], // Kuning, Hijau, Biru, Ungu, Pink, Teal
            BAR_COLOR: '#059669', // Hijau Bar
        };


        // --- FUNGSI UTILITY UNTUK KODE DUPLIKASI CHART ---

        /**
         * Fungsi untuk merender Doughnut Chart.
         * Digunakan untuk PPDB, Jenis Kelamin, dan Tingkat.
         */
        function renderDoughnutChart(canvasId, title, dataMap, colors) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            
            // Siapkan Data
            const labels = Object.keys(dataMap);
            const dataCounts = Object.values(dataMap);
            const total = dataCounts.reduce((a, b) => a + b, 0);
            const hasData = total > 0;

            // Destroy instance chart lama jika ada
            if (charts[canvasId]) charts[canvasId].destroy();
            ctx.clearRect(0, 0, canvas.width, canvas.height);


            const data = {
                labels: labels,
                datasets: [{
                    data: dataCounts,
                    backgroundColor: colors,
                    borderColor: '#ffffff', // Border putih antar segmen
                    borderWidth: 2
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false,
                datasets: {
                    doughnut: {
                        hoverOffset: 15,
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 10
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const value = context.parsed;
                                const percentage = ((value / total) * 100).toFixed(1) + '%';
                                return `${context.label}: ${value} (${percentage})`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value) => {
                            if (value === 0) return '';
                            const percentage = (value * 100 / total).toFixed(1) + "%";
                            return percentage;
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        anchor: 'center',
                        align: 'center'
                    }
                },
                cutout: '40%',
            };
            
            if (hasData) {
                charts[canvasId] = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: options,
                    plugins: [ChartDataLabels]
                });
            } else {
                ctx.fillStyle = '#6b7280';
                ctx.font = '16px sans-serif';
                ctx.textAlign = 'center';
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2;
                if (canvas.height > 0 && canvas.width > 0) {
                    ctx.fillText('Tidak ada data yang tersedia.', centerX, centerY);
                }
            }
        }

/**
 * Fungsi untuk merender Bar Chart (Tahun Masuk).
 */
function renderYearChart(dataFromFetch) {
    const canvasId = 'yearChart';
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    
    const dataMap = dataFromFetch.studentsPerYear || {};
    const labels = Object.keys(dataMap);
    const dataCounts = Object.values(dataMap);
    const total = dataCounts.reduce((a, b) => a + b, 0);
    const hasData = total > 0;

    // === PERBAIKAN 1: Menghitung nilai Maksimum untuk Sumbu Y ===
    const maxData = hasData ? Math.max(...dataCounts) : 0;
    
    // Menentukan batas maksimal sumbu Y.
    // Jika maxData adalah 5, yMax akan menjadi 6.
    // Jika maxData adalah 155, yMax akan menjadi 156.
    // Jika maxData besar (misal 100+), kita tambahkan buffer yang lebih besar.
    let yMax = maxData;

    if (maxData > 0) {
        if (maxData <= 10) {
             yMax = maxData + 1; // Jika data kecil (<=10), tambahkan 1
        } else if (maxData <= 100) {
             yMax = maxData + 5; // Jika data sedang (<=100), tambahkan 5
        } else {
             yMax = maxData + 10; // Jika data besar (>100), tambahkan 10
        }
    }


    if (charts[canvasId]) charts[canvasId].destroy();
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Peserta Didik',
            data: dataCounts,
            backgroundColor: COLOR.BAR_COLOR,
            borderColor: COLOR.BAR_COLOR,
            borderWidth: 1,
            borderRadius: 5,
        }]
    };

    const options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                // === PERBAIKAN 2: Mengatur batas maksimal sumbu Y ===
                max: yMax,
                ticks: {
                    // Memastikan ticks dan grid line muncul pada kelipatan 1 
                    // (Hanya berlaku jika yMax tidak terlalu besar)
                    stepSize: 1, 
                    callback: function(value) {
                        if (value % 1 === 0) {
                            return value;
                        }
                    }
                },
            },
            x: {
                grid: {
                    display: false, // Grid X tetap disembunyikan
                }
            }
        },
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                callbacks: {
                    label: (context) => `Jumlah: ${context.parsed.y}`,
                }
            },
            // === PERBAIKAN 3: Datalabels dari permintaan sebelumnya (Offset: -16, Size: 18) ===
            datalabels: {
                anchor: 'end',
                align: 'top',
                offset: -5, 
                formatter: (value) => value,
                color: '#1F2937', 
                font: {
                    weight: 'bold',
                    size: 18 
                }
            }
        }
    };

    if (hasData) {
        charts[canvasId] = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options,
            plugins: [ChartDataLabels]
        });
    } else {
        ctx.fillStyle = '#6b7280';
        ctx.font = '16px sans-serif';
        ctx.textAlign = 'center';
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        if (canvas.height > 0 && canvas.width > 0) {
            ctx.fillText('Tidak ada data Tahun Masuk yang tersedia.', centerX, centerY);
        }
    }
}

        // 2. **FUNGSI RENDER UTAMA UNTUK KETIGA CHART GABUNGAN**

        function renderAllCombinedCharts(dataFromFetch) {
            // 2.1. PPDB CHART
            const ppdbDataMap = {
                'Diterima': dataFromFetch.totalAccepted || 0,
                'Menunggu Konfirmasi': dataFromFetch.totalPending || 0,
                'Ditolak': dataFromFetch.totalRejected || 0
            };
            const ppdbColors = [COLOR.DITERIMA, COLOR.MENUNGGU, COLOR.DITOLAK];
            renderDoughnutChart('ppdbChart', 'Status PPDB', ppdbDataMap, ppdbColors);
            
            // 2.2. GENDER CHART
            const genderDataMap = dataFromFetch.studentsPerGender || {};
            const genderLabels = Object.keys(genderDataMap);
            const genderColors = genderLabels.map(label => {
                if (label.toLowerCase().includes('laki')) return COLOR.LAKI_LAKI;
                if (label.toLowerCase().includes('perempuan')) return COLOR.PEREMPUAN;
                return '#A0AEC0';
            });
            renderDoughnutChart('genderChart', 'Peserta Didik per Jenis Kelamin', genderDataMap, genderColors);

            // 2.3. TINGKAT CHART
            const tingkatDataMap = dataFromFetch.studentsPerTingkat || {};
            // Mengambil hanya 6 warna pertama, atau ulangi jika ada lebih banyak tingkat
            const tingkatColors = (Object.keys(tingkatDataMap).map((_, index) => COLOR.TINGKAT_COLORS[index % COLOR.TINGKAT_COLORS.length]));
            renderDoughnutChart('tingkatChart', 'Peserta Didik per Tingkat', tingkatDataMap, tingkatColors);
        }

        // 3. **FUNGSI UNTUK MENGONTROL VISIBILITAS CHART MELALUI DROPDOWN**
        function showSelectedChart(chartType) {
            // Mapping tipe chart ke ID container
            const containerMap = {
                'ppdb': 'chart-ppdb-container',
                'gender': 'chart-gender-container',
                'tingkat': 'chart-tingkat-container'
            };
            
            // Iterasi melalui semua container
            Object.keys(containerMap).forEach(key => {
                const containerId = containerMap[key];
                const container = document.getElementById(containerId);
                
                if (container) {
                    if (key === chartType) {
                        container.classList.remove('hidden');
                        // Memastikan chart di resize agar terlihat dengan benar setelah ditampilkan
                        // Chart.js perlu di-resize ulang jika parent-nya baru saja diubah dari display: none
                        if (charts[key + 'Chart']) {
                             charts[key + 'Chart'].resize();
                        }
                    } else {
                        container.classList.add('hidden');
                    }
                }
            });
        }


        // 4. **FUNGSI UNTUK MENGAMBIL DATA UTAMA & MEMPERBARUI CARD + CHART**
        function updateDashboardStats() {
            console.log("--- DEBUG: Starting fetch process ---");
            const statsUrl = '<?php echo e(route('teacher.dashboard.stats.json')); ?>';

            fetch(statsUrl)
                .then(response => {
                    if (response.status !== 200) {
                        // Membuang respons teks untuk membantu debugging
                        return response.text().then(text => {
                            throw new Error(`Status Jaringan HTTP Error: ${response.status} | Respons Server: ${text.substring(0, 200)}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    latestFetchedData = data;

                    // Perbarui nilai di Card HTML (Total & PPDB)
                    document.getElementById('stat-students').innerText = data.totalStudents || 0;
                    document.getElementById('stat-ppdb').innerText = data.totalPpdb || 0;
                    document.getElementById('stat-accepted').innerText = data.totalAccepted || 0;
                    document.getElementById('stat-pending').innerText = data.totalPending || 0;
                    document.getElementById('stat-rejected').innerText = data.totalRejected || 0;

                    // Panggil fungsi render chart
                    renderAllCombinedCharts(latestFetchedData);
                    renderYearChart(latestFetchedData);
                    
                    // Tampilkan chart yang sedang terpilih di dropdown setelah data baru dirender
                    const selector = document.getElementById('chartSelector');
                    const selectedValue = selector ? selector.value : 'ppdb';
                    showSelectedChart(selectedValue);

                })
                .catch(error => {
                    console.error('!!! FETCH API GAGAL!!! Cek Network/Route:', error.message);
                    const chartContainerCombined = document.querySelector('.bg-white.p-6.shadow-xl.rounded-lg');
                    if (chartContainerCombined) {
                        // Menampilkan pesan error di container utama
                        chartContainerCombined.innerHTML = `<div class="text-center text-red-500 p-10">
                            Gagal memuat data grafik. Cek Console untuk detailnya!
                            <p class="text-sm mt-2 text-red-700">Error: ${error.message}</p>
                            </div>`;
                    }
                    // Menampilkan error pada card Tahun Masuk juga (opsional)
                    const chartContainerYear = document.querySelector('#yearChart').closest('.bg-white.p-6.shadow-xl.rounded-lg');
                    if (chartContainerYear) {
                         chartContainerYear.innerHTML = `<h3 class="text-2xl font-semibold text-gray-700 mb-4 text-center">
                            JUMLAH PESERTA DIDIK PER TAHUN MASUK
                            </h3><div class="text-center text-red-500 p-10">
                            Gagal memuat data grafik. Cek Console untuk detailnya!
                            </div>`;
                    }
                });
        }

        // 5. **LISTENER & INISIALISASI**
        document.addEventListener('DOMContentLoaded', function() {
            // Setup listener untuk dropdown
            const selector = document.getElementById('chartSelector');
            if(selector) {
                selector.addEventListener('change', (event) => {
                    showSelectedChart(event.target.value);
                });
            }
            
            // Inisialisasi pada load
            updateDashboardStats();
            
            // Refresh setiap 10 detik
            setInterval(updateDashboardStats, 10000); 
        });
    </script>
    

</body>
</html>
<?php echo $__env->make('templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/teacher/dashboard.blade.php ENDPATH**/ ?>