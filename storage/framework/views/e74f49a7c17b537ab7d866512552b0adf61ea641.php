<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDIKMM</title>

    
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
     <?php $__env->slot('header', null, []); ?> 
        <div style="margin-bottom: 40px;">
        </div>
     <?php $__env->endSlot(); ?>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased bg-gray-100"
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
                        <a :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')">
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('teacher.dashboard'),'active' => request()->routeIs('teacher.dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.dashboard'))]); ?>
                            <?php echo e(__('Dashboard')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('teacher.data-peserta-didik'),'active' => request()->routeIs('teacher.datapesertadidik')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.data-peserta-didik')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.datapesertadidik'))]); ?>
                            <?php echo e(__('Data Peserta Didik')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('teacher.data-ppdb'),'active' => request()->routeIs('teacher.datappdb')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.data-ppdb')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.datappdb'))]); ?>
                            <?php echo e(__('Data PPDB')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('teacher.informasi'),'active' => request()->routeIs('teacher.informasi')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.informasi')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.informasi'))]); ?>
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
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div><?php echo e(Auth::user()->name); ?></div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                         <?php $__env->endSlot(); ?>

                         <?php $__env->slot('content', null, []); ?> 
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
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
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('teacher.dashboard'),'active' => request()->routeIs('teacher.dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.dashboard'))]); ?>
                    <?php echo e(__('Dashboard')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('teacher.data-peserta-didik'),'active' => request()->routeIs('teacher.datapesertadidik')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.data-peserta-didik')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.datapesertadidik'))]); ?>
                    <?php echo e(__('Data Peserta Didik')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('teacher.data-ppdb'),'active' => request()->routeIs('teacher.datappdb')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.data-ppdb')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.datappdb'))]); ?>
                    <?php echo e(__('Data PPDB')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('teacher.informasi'),'active' => request()->routeIs('teacher.informasi')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('teacher.informasi')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teacher.informasi'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
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

    <section class="form-ppdb-container" style="min-height: 85vh; margin-bottom: 40px; margin-top: 40px;">
        <div class="form-header">
            <h1>Edit Formulir Pendaftaran Peserta Didik Baru <br>
                (<?php echo e($formulir->no_form); ?>)</h1>
            <p>Perbarui data anak Anda di bawah ini. Dokumen dan perubahan akan diverifikasi ulang.</p>
        </div>

        <?php if(session('success')): ?>
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; border-radius: .25rem; color: #155724; background-color: #d4edda;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <p style="font-weight: bold; margin-top: 0;">Pembaruan gagal karena kesalahan berikut:</p>
                <ul style="margin: 0; padding-left: 20px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('failure')): ?>
            <div style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <?php echo e(session('failure')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('teacher.data-ppdb.update', $formulir->no_form)); ?>" enctype="multipart/form-data" class="ppdb-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            
            <fieldset class="form-section">
                <legend>1. Data Pribadi Calon Siswa (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        <input type="text" id="nama_pd" name="nama_pd" value="<?php echo e(old('nama_pd', $formulir->nama_pd)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        <input type="text" id="tlahir" name="tlahir" value="<?php echo e(old('tlahir', $formulir->tlahir)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        <input type="date" id="tgllahir" name="tgllahir" value="<?php echo e(old('tgllahir', $formulir->tgllahir)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="jk">Jenis Kelamin</label>
                        <select id="jk" name="jk" required>
                            <option value="" disabled hidden>Pilih Jenis Kelamin</option>
                            <?php if(isset($jenisKelamin)): ?>
                                <?php $__currentLoopData = $jenisKelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jkItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jkItem->id); ?>" <?php echo e(old('jk', $formulir->jenis_kelamin_id) == $jkItem->id ? 'selected' : ''); ?>><?php echo e($jkItem->jk); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-field full-width">
                        <label for="alamat">Alamat Lengkap</label>
                        <input type="text" id="alamat" name="alamat" value="<?php echo e(old('alamat', $formulir->alamat)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="tingkat">Tingkat Pendaftaran</label>
                        <select id="tingkat" name="tingkat" required>
                            <option value="" disabled hidden>Pilih Tingkat</option>
                            <?php if(isset($tingkats)): ?>
                                <?php $__currentLoopData = $tingkats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tingkatItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tingkatItem->id); ?>" <?php echo e(old('tingkat', $formulir->tingkat_id) == $tingkatItem->id ? 'selected' : ''); ?>><?php echo e($tingkatItem->tingkat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </fieldset>

            
            <fieldset class="form-section">
                <legend>2. Data Orang Tua & Kontak (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        <input type="text" id="namaortu" name="namaortu" value="<?php echo e(old('namaortu', $formulir->namaortu)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        <input type="tel" id="notelportu" name="notelportu" value="<?php echo e(old('notelportu', $formulir->notelportu)); ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        <input type="text" id="namawali" name="namawali" value="<?php echo e(old('namawali', $formulir->namawali)); ?>">
                    </div>
                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        <input type="tel" id="notelpwali" name="notelpwali" value="<?php echo e(old('notelpwali', $formulir->notelpwali)); ?>">
                    </div>
                </div>
            </fieldset>

            
            <fieldset class="form-section">
                <legend>3. Upload Dokumen Pendukung</legend>
                <p class="warning-text">Format yang diterima: JPG, PNG, atau PDF. Ukuran maksimal 2MB per file. Kosongkan jika tidak ada perubahan.</p>
                <div class="form-group-grid two-columns">
                    <div class="form-field">
                        <label for="fotoanak">Pas Foto Anak Terbaru (3x4)</label>
                        <input type="file" id="fotoanak" name="fotoanak" accept=".jpg, .png, .pdf">
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            <?php if($formulir->fotoanak): ?>
                                <a href="<?php echo e(Storage::disk('gcs')->url($formulir->fotoanak)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                            <?php else: ?> Belum ada file. <?php endif; ?>
                        </p>
                        <img id="preview_fotoanak" src="" alt="Pratinjau Foto Anak" style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>
                    <div class="form-field">
                        <label for="fotokkk">Kartu Keluarga (KK) Asli</label>
                        <input type="file" id="fotokkk" name="fotokkk" accept=".jpg, .png, .pdf">
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            <?php if($formulir->fotokkk): ?>
                                <a href="<?php echo e(Storage::disk('gcs')->url($formulir->fotokkk)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                            <?php else: ?> Belum ada file. <?php endif; ?>
                        </p>
                        <img id="preview_fotokk" src="" alt="Pratinjau Foto KK" style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                    </div>
                </div>
            </fieldset>

            
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->isTeacher()): ?>
                    <fieldset class="form-section">
                        <legend>4. Status Pendaftaran, Data Siswa Aktif & Catatan Admin</legend>
                        
                        
                        <input type="hidden" id="status_form" name="status_form" value="<?php echo e(old('status_form', $formulir->status_form)); ?>">

                        <div class="form-group-grid two-columns">
                            
                            <div class="form-field">
                                <label for="status_id">Status Formulir Saat Ini</label>
                                <select id="status_id" name="status_id" required onchange="runBackgroundLogic()">
                                    <option value="" disabled hidden>Pilih Status</option>
                                    <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($statusItem->id); ?>" 
                                            data-name="<?php echo e(strtolower($statusItem->status)); ?>"
                                            <?php echo e(old('status_id', $formulir->status_id) == $statusItem->id ? 'selected' : ''); ?>>
                                            <?php echo e($statusItem->status); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div class="form-field">
                                <label for="tahun_masuk_id">Tahun Masuk (Jika Diterima)</label>
                                <select id="tahun_masuk_id" name="tahun_masuk_id">
                                    <option value="" disabled hidden>Pilih Tahun (Otomatis jika kosong)</option>
                                    <?php $__currentLoopData = $tahunMasukList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahunItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tahunItem->id); ?>"
                                            <?php echo e(old('tahun_masuk_id', $formulir->pesertaDidik->tahun_masuk_id ?? $formulir->tahun_masuk_id) == $tahunItem->id ? 'selected' : ''); ?>>
                                            <?php echo e($tahunItem->thnmasuk); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-field full-width">
                                <label for="note">Catatan Admin (Untuk Siswa/Wali)</label>
                                <textarea id="note" name="note" rows="3"><?php echo e(old('note', $formulir->note)); ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                <?php else: ?>
                    
                    <input type="hidden" name="status_id" value="<?php echo e($formulir->status_id); ?>">
                    <input type="hidden" name="status_form" value="<?php echo e($formulir->status_form); ?>">
                    <input type="hidden" name="note" value="<?php echo e($formulir->note); ?>">
                    <input type="hidden" name="tahun_masuk_id" value="<?php echo e($formulir->pesertaDidik->tahun_masuk_id ?? $formulir->tahun_masuk_id); ?>">
                <?php endif; ?>
            <?php endif; ?>

            <div class="form-actions">
                <a href="<?php echo e(route('teacher.data-ppdb')); ?>" class="back-button" style="margin-right: 10px;">Batal</a>
                <button type="submit" class="back-button" style="background-color: blue;">Simpan Pembaruan</button>
            </div>
        </form>
    </section>

    
    <script>
        // Logika Preview Gambar
        function setupImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!input || !img) return;
            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => { img.src = e.target.result; img.style.display = 'block'; }
                    reader.readAsDataURL(file);
                } else { img.style.display = 'none'; img.src = ''; }
            });
        }

        // Logika Otomatisasi Latar Belakang
        function runBackgroundLogic() {
            const statusSelect = document.getElementById('status_id');
            if (!statusSelect) return;

            const selectedOption = statusSelect.options[statusSelect.selectedIndex];
            const statusName = selectedOption.getAttribute('data-name') || '';
            
            const inputStatusForm = document.getElementById('status_form');
            const selectTahun = document.getElementById('tahun_masuk_id');
            
            // Mengambil ID Tahun Terbaru dari baris pertama list (laravel collection first)
            const idTahunTerbaru = "<?php echo e($tahunMasukList->first()->id ?? ''); ?>";

            // 1. Logika Lock/Unlock Otomatis
            if (statusName.includes('menunggu') || statusName.includes('tolak')) {
                inputStatusForm.value = 'unlocked';
            } else if (statusName.includes('terima') || statusName.includes('batal')) {
                inputStatusForm.value = 'locked';
            }

            // 2. Logika Tahun Masuk Otomatis (Tanpa Menimpa Pilihan Manual)
            if (statusName.includes('terima')) {
                // HANYA isi otomatis jika Guru belum memilih tahun (masih kosong)
                if (selectTahun.value === '') {
                    selectTahun.value = idTahunTerbaru;
                    // Flash effect untuk memberitahu user ada pengisian otomatis
                    selectTahun.style.backgroundColor = '#e0f2fe';
                    setTimeout(() => { selectTahun.style.backgroundColor = ''; }, 800);
                }
            } else {
                // Jika status bukan diterima, tahun sebaiknya dikosongkan/reset
                selectTahun.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setupImagePreview('fotoanak', 'preview_fotoanak');
            setupImagePreview('fotokkk', 'preview_fotokk');

            // Load gambar lama
            const fAnak = "<?php echo e($formulir->fotoanak ? Storage::disk('gcs')->url($formulir->fotoanak) : ''); ?>";
            const fKK = "<?php echo e($formulir->fotokkk ? Storage::disk('gcs')->url($formulir->fotokkk) : ''); ?>";
            if (fAnak && !fAnak.endsWith('.pdf')) { document.getElementById('preview_fotoanak').src = fAnak; document.getElementById('preview_fotoanak').style.display = 'block'; }
            if (fKK && !fKK.endsWith('.pdf')) { document.getElementById('preview_fotokk').src = fKK; document.getElementById('preview_fotokk').style.display = 'block'; }
        });
    </script>

    <?php if(session('update_success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update data Berhasil!',
                text: 'Data formulir No. <?php echo e($formulir->no_form); ?> telah berhasil diperbarui.',
                position: 'top',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });
        </script>
    <?php endif; ?>

    
</body>
</html>
<?php echo $__env->make('templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/teacher/edit-ppdb.blade.php ENDPATH**/ ?>