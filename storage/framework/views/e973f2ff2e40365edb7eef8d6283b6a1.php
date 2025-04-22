<?php if (isset($component)) { $__componentOriginal2de41bd58e79fb25b173007b6f0eaf19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2de41bd58e79fb25b173007b6f0eaf19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.modal','data' => ['title' => ''.isset($data->id) ? 'Edit Status Layanan' : 'Tambah Status Layanan'.'','action' => ''.e($action ?? null).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.isset($data->id) ? 'Edit Status Layanan' : 'Tambah Status Layanan'.'','action' => ''.e($action ?? null).'']); ?>
    <?php if($data->id): ?>
        <?php echo method_field('put'); ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'status','value' => ''.e($data->lokasi).'','label' => 'Status Pelayanan','placeholder' => 'Dalam Pelayanan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'status','value' => ''.e($data->lokasi).'','label' => 'Status Pelayanan','placeholder' => 'Dalam Pelayanan']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2de41bd58e79fb25b173007b6f0eaf19)): ?>
<?php $attributes = $__attributesOriginal2de41bd58e79fb25b173007b6f0eaf19; ?>
<?php unset($__attributesOriginal2de41bd58e79fb25b173007b6f0eaf19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2de41bd58e79fb25b173007b6f0eaf19)): ?>
<?php $component = $__componentOriginal2de41bd58e79fb25b173007b6f0eaf19; ?>
<?php unset($__componentOriginal2de41bd58e79fb25b173007b6f0eaf19); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/bukutamu/resources/views/pages/referensi/status-form.blade.php ENDPATH**/ ?>