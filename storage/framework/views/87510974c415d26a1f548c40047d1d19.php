<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfigurasi /</span> Permission</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Ajax Sourced Server-side</h5>
                <div class="d-flex gap-1">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create konfigurasi/permissions')): ?>
                        <a class="btn btn-primary action" href="<?php echo e(route('konfigurasi.permissions.create')); ?>">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Permission
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
        const datatable = 'permission-table'

        handleAction(datatable)
        handleDelete(datatable)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Permission'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/pages/konfigurasi/permission.blade.php ENDPATH**/ ?>