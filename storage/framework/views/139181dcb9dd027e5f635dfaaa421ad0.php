<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['size' => 'lg', 'title', 'action' => null ]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['size' => 'lg', 'title', 'action' => null ]); ?>
<?php foreach (array_filter((['size' => 'lg', 'title', 'action' => null ]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="modal-dialog modal-<?php echo e($size); ?>">
    <form id="form_action" <?php echo e($attributes->merge(['class' => 'modal-content'])); ?> action="<?php echo e($action); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle"><?php echo e($title); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php echo e($slot); ?>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
            <?php if($action): ?>
                <button type="submit" class="btn btn-primary">Simpan</button>
            <?php endif; ?>
        </div>
    </form>
</div><?php /**PATH /var/www/html/bukutamu/resources/views/components/form/modal.blade.php ENDPATH**/ ?>