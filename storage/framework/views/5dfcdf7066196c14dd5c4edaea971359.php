<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'label', 'value' => '', 'id' => $name, 'type' => 'text', 'help' => null]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'label', 'value' => '', 'id' => $name, 'type' => 'text', 'help' => null]); ?>
<?php foreach (array_filter((['name', 'label', 'value' => '', 'id' => $name, 'type' => 'text', 'help' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<label for="<?php echo e($id); ?>" class="form-label"><?php echo e($label); ?></label>
<input type="<?php echo e($type); ?>" id="<?php echo e($id); ?>" <?php echo e($attributes->merge(['class' => 'form-control'])); ?>

    name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
<?php if($help): ?>
    <div id="<?php echo e($id ?? $name); ?>-help" class="form-text text-muted mt-1"> <?php echo e($help); ?> </div>
<?php endif; ?>
<?php /**PATH /var/www/html/bukutamu/resources/views/components/form/input.blade.php ENDPATH**/ ?>