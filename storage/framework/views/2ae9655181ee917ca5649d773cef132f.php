<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>Schools</h3>
            <a href="#"  wire:click.prevent="$emitTo('admin.school.edit','load')" class="btn btn-primary text-white" wire:loading.attribute = 'disabled'>
                <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="load"></i>
                Add School
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm" placeholder="Search Here">
        </div>
    </div>
    <p class="sub-header">
        List of Schools
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>

                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($school->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.school.details', $school)); ?>" class="btn btn-default text-secondary"><i
                            class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.edit','load',<?php echo e($school); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delete','load',<?php echo e($school); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
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
    $html = \Livewire\Livewire::mount('admin.school.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l1343610758-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1343610758-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1343610758-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1343610758-0');
} else {
    $response = \Livewire\Livewire::mount('admin.school.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l1343610758-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l1343610758-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l1343610758-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1343610758-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1343610758-1');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l1343610758-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/school/index.blade.php ENDPATH**/ ?>