<?php $__env->startSection('content'); ?>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="<?php echo e(asset('assets/img/illustrations/auth-login-illustration-light.png')); ?>"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                    <img src="<?php echo e(asset('assets/img/illustrations/bg-shape-image-light.png')); ?>" alt="auth-login-cover"
                        class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-0 d-flex justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span>
                                <img src="<?php echo e(asset('assets/img/logo/small.png')); ?>" alt="SiRaja KoJa Logo" width="150"
                                    class="mb-0">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1 fw-bold text-center">Sistem Informasi Barang dan Jasa <br> Kota Jambi</h3>
                        

                        <form id="formAuthentication" class="mb-3" action="<?php echo e(route('login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="login" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="login" name="login"
                                    :value="old('login')" placeholder="Enter your email or username" required autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Anggaran</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="" disabled selected>Pilih Tahun Anggaran</option>
                                    <?php $__currentLoopData = $tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tahun->tahun); ?>"
                                            <?php echo e(old('tahun') == $tahun->tahun ? 'selected' : ''); ?>>
                                            <?php echo e($tahun->tahun); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" />
                                    <label class="form-check-label" for="remember"> <?php echo e(__('Ingat saya')); ?> </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                                <?php echo e(__('Masuk')); ?>

                            </button>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="auth-register-cover.html">
                                <span>Hubungi kami</span>
                            </a>
                        </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.layouts.app', ['title' => 'Login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/auth/login.blade.php ENDPATH**/ ?>