<?php $__env->startSection('title','Testimonial'); ?>
<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3><?php echo e(__('admin.testimonial')); ?></h3>
            <a href="#"  wire:click.prevent="$emitTo('admin.testimonial.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                <?php echo e(__('edits.add_testimonial')); ?>

            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="<?php echo e(__('tables.search')); ?>">
        </div>
    </div>
    <p class="sub-header">
        List of Testimonies
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('common.name')); ?></th>
                <th><?php echo e(__('edits.company')); ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($testimonial->name); ?></td>
                    <td><?php echo e($testimonial->company); ?></td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.testimonial.edit','load',<?php echo e($testimonial); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> <?php echo e(__('edits.edit')); ?></a>
                        <a href="#" wire:click.prevent="$emitTo('admin.testimonial.delete','load',<?php echo e($testimonial); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> <?php echo e(__('edits.delete')); ?></a>
                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="text-center py-4"><?php echo e(__('tables.no_entry')); ?></td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>

    
    <?php if($this->rows->count()): ?>
        <div class="mt-5">
            <?php echo e($this->rows->links()); ?>

        </div>
    <?php endif; ?>
    

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.testimonial.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l751589720-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l751589720-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l751589720-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l751589720-0');
} else {
    $response = \Livewire\Livewire::mount('admin.testimonial.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l751589720-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.testimonial.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l751589720-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l751589720-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l751589720-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l751589720-1');
} else {
    $response = \Livewire\Livewire::mount('admin.testimonial.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l751589720-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/testimonial/index.blade.php ENDPATH**/ ?>