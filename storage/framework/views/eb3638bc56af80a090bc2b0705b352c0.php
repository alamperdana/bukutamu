<?php if(Route::is('master-data.rekening.index')): ?>
<a 
    class="btn btn-sm btn-success rounded-pill btn-icon action" 
    href="<?php echo e(route('master-data.rekening.paguModal', $row->id)); ?>" 
    data-id="<?php echo e($row->id); ?>"
    title="Tambah Pagu Belanja">
    <i class="ti ti-cash" style="font-size: 24px;"></i>
</a>
<?php endif; ?>
<div class="btn-group">
    <button type="button" class="btn btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="ti ti-dots-vertical"></i>
    </button>
    <ul class="dropdown-menu">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a class="dropdown-item <?php echo e($key == 'Delete' ? 'delete' : 'action'); ?>"
                    href="<?php echo e($item); ?>"><?php echo e($key); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/action.blade.php ENDPATH**/ ?>