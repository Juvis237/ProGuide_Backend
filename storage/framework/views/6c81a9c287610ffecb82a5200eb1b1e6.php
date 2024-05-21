<?php $__env->startSection('title', 'Pages'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center  flex-wrap">
                <div class="col-md-6 col-lg-4 p-0 mb-4">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control"
                        placeholder="<?php echo e(__('tables.search')); ?>">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered m-10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('tables.title')); ?></th>
                            <th><?php echo e(__('tables.last_updated')); ?></th>
                            <th><?php echo e(__('tables.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($k + 1); ?></td>
                                <td><?php echo e($page->byLocale()->title); ?></td>
                                <td class="text-nowrap"><?php echo e($page->updated_at->diffForHumans()); ?></td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-secondary" href="#"
                                            wire:click.prevent = "$emitTo('admin.pages.edit', 'load', <?php echo e($page); ?>)">
                                            <?php echo e(__('edits.edit')); ?>

                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination" style="justify-content: center;margin-top: 20px;">
            <?php echo e($pages->links()); ?>

        </div>
    </div>
</div>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.pages.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l4244377391-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l4244377391-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l4244377391-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l4244377391-0');
} else {
    $response = \Livewire\Livewire::mount('admin.pages.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l4244377391-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/pages/index.blade.php ENDPATH**/ ?>