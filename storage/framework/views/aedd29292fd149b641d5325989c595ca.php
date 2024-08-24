<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>FAQs</h3>
            <a href="#"  wire:click.prevent="$emitTo('admin.faq.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                <?php echo e(__('edits.add_faq')); ?>

            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="<?php echo e(__('tables.search')); ?>">
        </div>
    </div>
    <p class="sub-header">
        List of FAQs
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('tables.question')); ?></th>
                <th><?php echo e(__('tables.answer')); ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($faq->byLocale()->question); ?></td>
                    <td><?php echo e($faq->byLocale()->answer); ?></td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.faq.edit','load',<?php echo e($faq); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> <?php echo e(__('edits.edit')); ?></a>
                        <a href="#" wire:click.prevent="$emitTo('admin.faq.delete','load',<?php echo e($faq); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> <?php echo e(__('edits.delete')); ?></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
    $html = \Livewire\Livewire::mount('admin.faq.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l442694222-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l442694222-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l442694222-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l442694222-0');
} else {
    $response = \Livewire\Livewire::mount('admin.faq.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l442694222-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.faq.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l442694222-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l442694222-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l442694222-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l442694222-1');
} else {
    $response = \Livewire\Livewire::mount('admin.faq.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l442694222-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/faq/index.blade.php ENDPATH**/ ?>