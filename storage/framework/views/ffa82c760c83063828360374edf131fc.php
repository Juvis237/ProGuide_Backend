<div>
    
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h3 class="text-capitalize"><?php echo e($type); ?></h3>
        <a href="#"  wire:click.prevent="$emitTo('admin.blog.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
            <?php echo e(__('edits.add_blog')); ?>

        </a>
    </div>

    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-end">
            <div class="mx-2">
                <select name="" class="form-control rounded-md " id="">
                    <option value=""><?php echo e(__('edits.category')); ?></option>
                </select>
            </div>
            <div>
                <select name="" class="form-control rounded-md " id="">
                    <option value=""><?php echo e(__('edits.status')); ?></option>
                </select>
            </div>

            <div class=" mb-3 mx-2">
                <div class="">
                    <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                           placeholder="Type to Search">
                </div>
            </div>
        </div>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('tables.title')); ?></th>
                <th><?php echo e(__('edits.category')); ?></th>
                <th><?php echo e(__('edits.status')); ?></th>
                <th><?php echo e(__('tables.created_on')); ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($loop->index + 1); ?></td>
                    <td><a href="<?php echo e(route('blog.detail', $blog)); ?>" class="text-primary"><?php echo e($blog->byLocale()->title); ?></a></td>
                    <td><?php echo e($blog->category->name); ?> </td>
                    <td><div class="badge <?php echo e($blog->status == 'draft'? 'badge-draft' : 'badge-success'); ?>">
                        <?php echo e(ucfirst($blog->status)); ?> </div></td>
                    <td><?php echo e($blog->created_at->format('d M Y')); ?></td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.publish','load',<?php echo e($blog); ?>)"
                        class="btn btn-default text-primary"><i class="fas fa-refresh"></i>  <?php echo e($blog->status==="published"?"un-Publish":"Publish"); ?></a>
                        <a href="<?php echo e(route('blog.detail', $blog)); ?>" class="btn btn-default text-secondary"><i
                                class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.edit','load',<?php echo e($blog); ?>)"
                           class="btn btn-default text-success"><i class="fa fa-pen"></i> <?php echo e(__('edits.edit')); ?></a>
                        <a href="#" wire:click.prevent="$emitTo('admin.blog.delete','load',<?php echo e($blog); ?>)"
                           class="btn btn-default text-danger"><i class="fa fa-trash"></i> <?php echo e(__('edits.delete')); ?></a>

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
    $html = \Livewire\Livewire::mount('admin.blog.edit', ['type' => $type])->html();
} elseif ($_instance->childHasBeenRendered('l2626747474-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2626747474-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2626747474-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2626747474-0');
} else {
    $response = \Livewire\Livewire::mount('admin.blog.edit', ['type' => $type]);
    $html = $response->html();
    $_instance->logRenderedChild('l2626747474-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.blog.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l2626747474-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l2626747474-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2626747474-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2626747474-1');
} else {
    $response = \Livewire\Livewire::mount('admin.blog.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l2626747474-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.blog.publish', [])->html();
} elseif ($_instance->childHasBeenRendered('l2626747474-2')) {
    $componentId = $_instance->getRenderedChildComponentId('l2626747474-2');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2626747474-2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2626747474-2');
} else {
    $response = \Livewire\Livewire::mount('admin.blog.publish', []);
    $html = $response->html();
    $_instance->logRenderedChild('l2626747474-2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>

<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/blog/index.blade.php ENDPATH**/ ?>