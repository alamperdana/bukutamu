<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfigurasi /</span> Akses Role</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Ajax Sourced Server-side</h5>
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
        const datatable = 'role-table'

        function handleCheckMenu() {
            $('.parent').on('click', function() {
                const childs = $(this).parents('tr').find('.child')
                childs.prop('checked', this.checked) 
            })

            $('.child').on('click', function() {
                const parent = $(this).parents('tr')
                const childs = parent.find('.child')
                const checked = parent.find('.child:checked')

                parent.find('.parent').prop('checked', childs.length == checked.length)
            })

            $('.parent').each(function() {
                const parent = $(this).parents('tr')
                const childs = parent.find('.child')
                const checked = parent.find('.child:checked')

                parent.find('.parent').prop('checked', childs.length == checked.length)
            })
        }

        handleAction(datatable, function() {
            handleCheckMenu()
            $('.search').on('keyup', function() {
                const value = this.value.toLowerCase()
                $('#menu_permissions tr').show().filter(function(i, item) {
                    return item.innerText.toLowerCase().indexOf(value) == '-1'
                }).hide()
            })

            $('.copy-role').on('change', function() {
                handleAjax(`<?php echo e(url('konfigurasi/akses-role')); ?>/${this.value}/role`)
                .onSuccess(function(res) {
                    $('#menu_permissions').html(res)
                    handleCheckMenu()
                }, false)
                .execute()
            })
        })
        
        handleDelete(datatable)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Akses Role'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/pages/konfigurasi/akses-role.blade.php ENDPATH**/ ?>