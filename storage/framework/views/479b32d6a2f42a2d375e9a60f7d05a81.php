<p class="sub-header">
    Delivrable Modes
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Duration/Days</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $delivrable->modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($mode->name); ?></td>
                    <td><?php echo e($mode->price); ?></td>
                    <td><?php echo e($mode->duration); ?></td>
                    <td>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.mode.edit','load',<?php echo e($delivrable); ?>, <?php echo e($mode); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.mode.delete','load',<?php echo e($mode); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delivrable.modes.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l980663616-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l980663616-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l980663616-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l980663616-0');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delivrable.modes.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l980663616-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/school/delivrable/modes/index.blade.php ENDPATH**/ ?>