<div>
    
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h3 class="text-capitalize">User Requests</h3>

    </div>

    <div class="rounded-lg bg-white p-2 py-4">
        <div class="d-flex justify-content-end">
            <div>
                <select name="" wire:model='filters.status' class="form-control rounded-md " id="">
                    <option value="">Status</option>
                    <?php $__currentLoopData = \App\Models\Request::STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item); ?>"><?php echo e(strtoupper($item)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <th>User</th>
                <th>Delivrable</th>
                <th>Mode</th>
                <th>Status</th>
                <th>Scan Copy</th>
                <th>Assigned To</th>
                <th>Date</th>
                <th>Duration</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($loop->index + 1); ?></td>
                    <td><?php echo e($request->user->name); ?></td>
                    <td><?php echo e($request->delivrable->name); ?> </td>
                    <td><?php echo e($request->mode->name); ?></td>
                    <td>
                        <div class="badge badge-success p-2"><?php echo e(ucfirst($request->status)); ?></div>
                    </td>
                    <td>
                        <?php echo e($request->scan_copy? 'Yes' : 'No'); ?>

                    </td>
                    <td><?php echo e($request->assignedTo?->name); ?></td>
                    <td><?php echo e($request->created_at->format('d M Y')); ?></td>
                    <td><?php echo e(isset($request->delivrable->duration)? $request->delivrable->duration : $request->mode->duration); ?> Days</td>
                    <td>
                        <?php if($request->status != 'assigned'): ?>
                        <a href="#" wire:click.prevent="$emitTo('admin.request.assign','load',<?php echo e($request); ?>)"
                           class="btn btn-default text-success"><i class="fa fa-pen"></i> Assign</a>
                        <?php endif; ?>
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
    $html = \Livewire\Livewire::mount('admin.request.assign', [])->html();
} elseif ($_instance->childHasBeenRendered('l1112294399-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1112294399-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1112294399-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1112294399-0');
} else {
    $response = \Livewire\Livewire::mount('admin.request.assign', []);
    $html = $response->html();
    $_instance->logRenderedChild('l1112294399-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/request/index.blade.php ENDPATH**/ ?>