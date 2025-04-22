<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <?php $__currentLoopData = menus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $showCategory = true;
            ?>
            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read ' . $mm->url)): ?>
                    <?php if($showCategory): ?>
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-uppercase"><?php echo e($category); ?></span>
                        </li>
                        <?php
                            $showCategory = false;
                        ?>
                    <?php endif; ?>
                    <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'menu-item',
                        'active open' => str_contains(request()->path(), $mm->url),
                    ]); ?>">
                        <?php if(count($mm->subMenus)): ?>
                            <a href="#" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-<?php echo e($mm->icon); ?>"></i>
                                <div data-i18n="<?php echo e($mm->name); ?>"></div>
                            </a>
                            <ul class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'menu-sub',
                                'expand' => str_contains(request()->path(), $mm->url),
                            ]); ?>">
                                <?php $__currentLoopData = $mm->subMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read ' . $sm->url)): ?>
                                        <li class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'menu-item',
                                            'active' => str_contains(request()->path(), $sm->url),
                                        ]); ?>">
                                            <a href="<?php echo e(url($sm->url)); ?>" class="menu-link">
                                                <div data-i18n="<?php echo e($sm->name); ?>"></div>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo e(url($mm->url)); ?>" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-<?php echo e($mm->icon); ?>"></i>
                                <div data-i18n="<?php echo e($mm->name); ?>"></div>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</aside>
<!-- / Menu -->
<?php /**PATH /var/www/html/bukutamu/resources/views/layouts/menu.blade.php ENDPATH**/ ?>