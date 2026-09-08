<header class="header">
    <div class="header-left">
        <div class=" school-info">
            
            <a href="/"><img src="https://mettamaitreya.sch.id/assets/images/logo-header.png" alt="Logo Sekolah" style="width: auto;" class="logo"></a>
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


<?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/templates/header.blade.php ENDPATH**/ ?>