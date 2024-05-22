<div>
    <div class="mt-5">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
                <h3 class="text-capitalize"><?php echo e($type); ?> <?php echo e(__('admin.categories')); ?></h3>

                <?php if(isset($category_id)): ?>
                    <a href="#"  wire:click.prevent="$emitTo('admin.categories.add-sub','load', <?php echo e($category); ?>)" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            <?php echo e(__('edits.add_subcategory')); ?>

                        </div>
                    </a>
                <?php endif; ?>
                <?php if(!isset($category_id)): ?>
                    <a href="#"  wire:click.prevent="$emitTo('admin.categories.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                        <div>
                            <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                            <?php echo e(__('edits.add_category')); ?>

                        </div>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-lg-4">
                <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="<?php echo e(__('tables.search')); ?>">
            </div>
        </div>
        <p class="sub-header">
            List of  categories
        </p>

        <div class="table-responsive">
            <table class="table table-bordered m-0">

                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('common.name')); ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr wire:key="<?php echo e($k); ?>">
                        <td><?php echo e($k+1); ?></td>
                        <td><?php echo e($category->name); ?></td>
                        <td>
                            <?php if($category->type == 'product' && !isset($category->parent_id)): ?>
                                <a href="<?php echo e(route('categories',['category'=>$category])); ?>" class="btn btn-default text-secondary"><i class="fa fa-pen"></i> <?php echo e(__('edits.sub_category')); ?></a>
                            <?php endif; ?>

                            <a href="#" wire:click.prevent="$emitTo('admin.categories.edit','load',<?php echo e($category); ?>)" class="btn btn-default text-success"><i class="fa fa-pen"></i> <?php echo e(__('edits.edit')); ?></a>
                            <a href="#" wire:click.prevent="$emitTo('admin.categories.delete','load',<?php echo e($category); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> <?php echo e(__('edits.delete')); ?></a>
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
    $html = \Livewire\Livewire::mount('admin.categories.edit', ['type' => $type])->html();
} elseif ($_instance->childHasBeenRendered('l333656820-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l333656820-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l333656820-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l333656820-0');
} else {
    $response = \Livewire\Livewire::mount('admin.categories.edit', ['type' => $type]);
    $html = $response->html();
    $_instance->logRenderedChild('l333656820-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.categories.add-sub', [])->html();
} elseif ($_instance->childHasBeenRendered('l333656820-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l333656820-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l333656820-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l333656820-1');
} else {
    $response = \Livewire\Livewire::mount('admin.categories.add-sub', []);
    $html = $response->html();
    $_instance->logRenderedChild('l333656820-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.categories.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l333656820-2')) {
    $componentId = $_instance->getRenderedChildComponentId('l333656820-2');
    $componentTag = $_instance->getRenderedChildComponentTagName('l333656820-2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l333656820-2');
} else {
    $response = \Livewire\Livewire::mount('admin.categories.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l333656820-2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/categories/index.blade.php ENDPATH**/ ?>