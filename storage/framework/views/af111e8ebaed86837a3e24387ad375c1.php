<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfigurasi /</span> Menu</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Ajax Sourced Server-side</h5>
                <div class="d-flex gap-1">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create konfigurasi/menu')): ?>
                        <a class="btn btn-primary action" href="<?php echo e(route('konfigurasi.menu.create')); ?>">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Menu
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sort konfigurasi/menu')): ?>
                        <a class="btn btn-info sort" href="<?php echo e(route('konfigurasi.menu.sort')); ?>">
                            <span class="tf-icons ti-xs ti ti-arrows-down-up me-2"></span>Sort Menu
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive">
                        <table class="datatables-ajax table">
                            <?php echo $dataTable->table(); ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo $dataTable->scripts(); ?>


    <script>
        const datatable = 'menu-table';

        function handleMenuChange() {
            $('[name=level_menu]').on('change', function() {
                if (this.value == 'sub_menu') {
                    $('#main_menu_wrapper').removeClass('d-none')
                } else {
                    $('#main_menu_wrapper').addClass('d-none')
                }
            })
        }

        $('.sort').on('click', function(e) {
            e.preventDefault()

            handleAjax(this.href, 'put')
                .onSuccess(function(res) {
                    window.location.reload()
                }, false)
                .execute()
        })

        handleAction(datatable, function() {
            handleMenuChange()
        })

        handleDelete(datatable)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/pages/konfigurasi/menu.blade.php ENDPATH**/ ?>