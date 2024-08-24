<div class="mt-5">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-lg-8 d-flex justify-content-between align-items-center">
            <h3>Constants</h3>
        </div>
    </div>
    <p class="sub-header">
        List of constants
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Value</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = \App\Models\Constant::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$constant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($constant->name); ?></td>
                    <td><?php echo e($constant->value); ?></td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.constant.edit','load',<?php echo e($constant); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>


    

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.constant.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l798227113-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l798227113-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l798227113-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l798227113-0');
} else {
    $response = \Livewire\Livewire::mount('admin.constant.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l798227113-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/constant/index.blade.php ENDPATH**/ ?>