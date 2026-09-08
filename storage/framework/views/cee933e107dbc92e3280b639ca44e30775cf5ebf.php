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
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <?php $__env->slot('header', null, []); ?> 
        <div style="margin-bottom: 40px;">
            
        </div>
     <?php $__env->endSlot(); ?>

    
    <?php
        $isLocked = ($formulir->status_form == 'locked');
        $disabledAttribute = $isLocked ? 'disabled' : '';
    ?>

    <section class="form-ppdb-container">
        <div class="form-header">
            <h1>Edit Formulir Pendaftaran Peserta Didik Baru </br>
                (<?php echo e($formulir->no_form); ?>)</h1>
            
            <?php if($isLocked): ?>
                <p class="text-red-700 font-semibold" style="margin-top: 10px;">
                    Formulir ini telah dikunci oleh panitia dan tidak dapat diubah.
                </p>
            <?php else: ?>
                <p>Perbarui data anak Anda di bawah ini. Dokumen dan perubahan akan diverifikasi ulang.</p>
            <?php endif; ?>

            
            <?php if(!empty($formulir->noted)): ?>
                <div class="mt-4 p-3 bg-yellow-100 border border-yellow-300 rounded-lg">
                    <p class="font-semibold text-yellow-800">Catatan Panitia:</p>
                    <p class="text-yellow-700 whitespace-pre-line"><?php echo e($formulir->noted); ?></p>
                </div>
            <?php endif; ?>
        </div>

        
        <?php if(session('success')): ?>
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #d4edda; border-radius: .25rem; color: #155724; background-color: #d4edda;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <p style="font-weight: bold; margin-top: 0;">Pembaruan gagal karena kesalahan berikut:</p>
                <ul style="margin: 0; padding-left: 20px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('failure')): ?>
            <div
                style="padding: 15px; margin-bottom: 20px; border: 1px solid #f8d7da; border-radius: .25rem; color: #721c24; background-color: #f8d7da;">
                <?php echo e(session('failure')); ?>

            </div>
        <?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('formulir.update', $formulir->no_form)); ?>" enctype="multipart/form-data"
            class="ppdb-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            
            <fieldset class="form-section">
                <legend>1. Data Pribadi Calon Siswa (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="nama_pd">Nama Lengkap</label>
                        
                        <input type="text" id="nama_pd" name="nama_pd"
                            value="<?php echo e(old('nama_pd', $formulir->nama_pd)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['nama_pd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="tlahir">Tempat Lahir</label>
                        
                        <input type="text" id="tlahir" name="tlahir"
                            value="<?php echo e(old('tlahir', $formulir->tlahir)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['tlahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="tgllahir">Tanggal Lahir</label>
                        
                        <input type="date" id="tgllahir" name="tgllahir"
                            value="<?php echo e(old('tgllahir', $formulir->tgllahir)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['tgllahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="jk">Jenis Kelamin</label>
                        
                        <select id="jk" name="jk" required <?php echo e($disabledAttribute); ?>>
                            <option value="">Pilih Jenis Kelamin</option>
                            <?php if(isset($jenisKelamin)): ?>
                                <?php $__currentLoopData = $jenisKelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jkItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jkItem->id); ?>"
                                        <?php echo e(old('jk', $formulir->jenis_kelamin_id) == $jkItem->id ? 'selected' : ''); ?>>
                                        <?php echo e($jkItem->jk); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['jk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field full-width">
                        <label for="alamat">Alamat Lengkap</label>
                        
                        <input type="text" id="alamat" name="alamat"
                            value="<?php echo e(old('alamat', $formulir->alamat)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="tingkat">Tingkat Pendaftaran</label>
                        
                        <select id="tingkat" name="tingkat" required <?php echo e($disabledAttribute); ?>>
                            <option value="">Pilih Tingkat</option>
                            <?php if(isset($tingkats)): ?>
                                <?php $__currentLoopData = $tingkats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tingkatItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tingkatItem->id); ?>"
                                        <?php echo e(old('tingkat', $formulir->tingkat_id) == $tingkatItem->id ? 'selected' : ''); ?>>
                                        <?php echo e($tingkatItem->tingkat); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['tingkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </fieldset>

            
            <fieldset class="form-section">
                <legend>2. Data Orang Tua & Kontak (Wajib)</legend>
                <div class="form-group-grid">
                    <div class="form-field">
                        <label for="namaortu">Nama Ayah/Ibu Kandung</label>
                        
                        <input type="text" id="namaortu" name="namaortu"
                            value="<?php echo e(old('namaortu', $formulir->namaortu)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['namaortu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="notelportu">Nomor HP Orang Tua</label>
                        
                        <input type="tel" id="notelportu" name="notelportu"
                            value="<?php echo e(old('notelportu', $formulir->notelportu)); ?>" required <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['notelportu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="namawali">Nama Wali (Jika Ada)</label>
                        
                        <input type="text" id="namawali" name="namawali"
                            value="<?php echo e(old('namawali', $formulir->namawali)); ?>" <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['namawali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-field">
                        <label for="notelpwali">Nomor HP Wali</label>
                        
                        <input type="tel" id="notelpwali" name="notelpwali"
                            value="<?php echo e(old('notelpwali', $formulir->notelpwali)); ?>" <?php echo e($disabledAttribute); ?>>
                        <?php $__errorArgs = ['notelpwali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </fieldset>

            
            <fieldset class="form-section">
                <legend>3. Upload Dokumen Pendukung</legend>
                <p class="warning-text">Format yang diterima: JPG, PNG, atau PDF. Ukuran maksimal 2MB per file.
                    Kosongkan jika tidak ada perubahan.</p>

                <div class="form-group-grid two-columns">

                    <div class="form-field">
                        <label for="fotoanak">Pas Foto Anak Terbaru (3x4)</label>
                        
                        <input type="file" id="fotoanak" name="fotoanak" accept=".jpg, .png, .pdf" <?php echo e($disabledAttribute); ?>>
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            <?php if($formulir->fotoanak): ?>
                                <a href="<?php echo e(Storage::disk('gcs')->url($formulir->fotoanak)); ?>" target="_blank"
                                    class="text-blue-600 hover:underline">Lihat File</a>
                            <?php else: ?>
                                Belum ada file.
                            <?php endif; ?>
                        </p>
                        <img id="preview_fotoanak" src="" alt="Pratinjau Foto Anak"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                        <?php $__errorArgs = ['fotoanak'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-field">
                        <label for="fotokkk">Kartu Keluarga (KK) Asli</label>
                        
                        <input type="file" id="fotokkk" name="fotokkk" accept=".jpg, .png, .pdf" <?php echo e($disabledAttribute); ?>>
                        <p class="text-sm text-gray-500 mt-1">File saat ini:
                            <?php if($formulir->fotokkk): ?>
                                <a href="<?php echo e(Storage::disk('gcs')->url($formulir->fotokkk)); ?>" target="_blank"
                                    class="text-blue-600 hover:underline">Lihat File</a>
                            <?php else: ?>
                                Belum ada file.
                            <?php endif; ?>
                        </p>
                        <img id="preview_fotokk" src="" alt="Pratinjau Foto KK"
                            style="max-width: 150px; max-height: 150px; margin-top: 10px; display: none; object-fit: cover;">
                        <?php $__errorArgs = ['fotokkk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <script>
                    function setupImagePreview(inputId, imgId) {
                        const input = document.getElementById(inputId);
                        const img = document.getElementById(imgId);
                        if (!input || !img) return;

                        input.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            } else {
                                img.style.display = 'none';
                                img.src = '';
                            }
                        });
                    }
                    document.addEventListener('DOMContentLoaded', () => {
                        setupImagePreview('fotoanak', 'preview_fotoanak');
                        setupImagePreview('fotokkk', 'preview_fotokk');

                        // LOGIC MENAMPILKAN GAMBAR LAMA SAAT LOAD
                        const fotoAnakUrl = "<?php echo e($formulir->fotoanak ? Storage::disk('gcs')->url($formulir->fotoanak) : ''); ?>";
                        const fotoKKUrl = "<?php echo e($formulir->fotokkk ? Storage::disk('gcs')->url($formulir->fotokkk) : ''); ?>";

                        // Menampilkan foto anak jika URL ada dan bukan PDF
                        if (fotoAnakUrl && (fotoAnakUrl.endsWith('.jpg') || fotoAnakUrl.endsWith('.png') || fotoAnakUrl
                                .endsWith('.jpeg'))) {
                            document.getElementById('preview_fotoanak').src = fotoAnakUrl;
                            document.getElementById('preview_fotoanak').style.display = 'block';
                        }

                        // Menampilkan foto KK jika URL ada dan bukan PDF
                        if (fotoKKUrl && (fotoKKUrl.endsWith('.jpg') || fotoKKUrl.endsWith('.png') || fotoKKUrl.endsWith(
                                '.jpeg'))) {
                            document.getElementById('preview_fotokk').src = fotoKKUrl;
                            document.getElementById('preview_fotokk').style.display = 'block';
                        }
                    });
                </script>
            </fieldset>

            
            <input type="hidden" name="status_id" value="<?php echo e($formulir->status_id); ?>">
            <input type="hidden" name="status_form" value="<?php echo e($formulir->status_form); ?>">
            <input type="hidden" name="noted" value="<?php echo e($formulir->noted); ?>">

            <div class="form-actions">
                
                <a href="<?php echo e(route('dashboard')); ?>" class="back-button" style="margin-right: 10px;">Batal</a>
                
                
                <?php if(!$isLocked): ?>
                    <button type="submit"
                        class="submit-button bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan
                        Pembaruan</button>
                <?php endif; ?>
            </div>
        </form>
    </section>

    
    <?php if(session('update_success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update data Berhasil!',
                text: 'Data formulir No. <?php echo e($formulir->no_form); ?> telah berhasil diperbarui.',

                // KOREKSI KRITIS: Menggunakan 'top' untuk memusatkan di bagian atas.
                position: 'top',

                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                // Pastikan tidak ada properti 'toast: true' jika Anda ingin pop-up yang besar
                // Jika Anda ingin tampilan seperti toast (kecil), tambahkan 'toast: true' di sini.

                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    <?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\lr_simdik\resources\views/datapd.blade.php ENDPATH**/ ?>