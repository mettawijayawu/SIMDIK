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

    <div style="min-height: 85vh; margin-bottom: 40px;">
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    <div class="max-w-xl mx-auto">
                        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Pengguna: <span
                                class="text-indigo-600"><?php echo e($user->username); ?></span></h1>

                        
                        <?php if(session('success')): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('admin.data-user.update', $user)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>

                            
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" name="name" id="name"
                                    value="<?php echo e(old('name', $user->name)); ?>"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Email</label>
                                <input type="email" name="email" id="email"
                                    value="<?php echo e(old('email', $user->email)); ?>"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username
                                    (Opsional)</label>
                                <input type="text" name="username" id="username"
                                    value="<?php echo e(old('username', $user->username)); ?>"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status
                                    Pengguna</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="user"
                                        <?php echo e(old('status', $user->status) == 'user' ? 'selected' : ''); ?>>User Biasa/Siswa
                                    </option>
                                    <option value="guru"
                                        <?php echo e(old('status', $user->status) == 'guru' ? 'selected' : ''); ?>>Guru/Teacher
                                    </option>
                                    <option value="admin"
                                        <?php echo e(old('status', $user->status) == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <hr class="my-6">

                            
                            

                            
                            

                            <div class="flex justify-end space-x-3">
                                <a href="<?php echo e(route('admin.data-user')); ?>"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/admin/data-user-edit.blade.php ENDPATH**/ ?>