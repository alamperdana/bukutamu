<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Tahun Anggaran</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Tahun Anggaran</h5>
                <div class="d-flex gap-1">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create master-data/tahun')): ?>
                        <a class="btn btn-primary action" href="<?php echo e(route('master-data.tahun.create')); ?>">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Tahun
                        </a>
                        <a class="btn btn-secondary action" href="<?php echo e(route('master-data.tahun.archive')); ?>">
                            <span class="tf-icons ti-xs ti ti-archive me-2"></span>Arsip
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
        const datatable = 'tahun-table'

        handleAction(datatable)
        handleDelete(datatable)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Tahun Anggaran'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/pages/master-data/tahun.blade.php ENDPATH**/ ?>