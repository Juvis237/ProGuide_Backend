<div>
    <div class="d-flex mb-5 justify-content-between align-items-center">
        <h4 class="text-capitalize">Manage Users</h4>
    </div>


    <div class="d-flex justify-content-end flex-column flex-lg-row">
        <div class=" mb-3 mr-2">
            <select  wire:model="filters.region" wire:change='set_cities'  class="form-control">
                <option disabled value=""><?php echo e(__('edits.select_region')); ?></option>
                <option  value=""><?php echo e(__('tables.all_regions')); ?></option>
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option  <?php echo e($reg->id == $filters['region']?"selected":""); ?> value="<?php echo e($reg->id); ?>"><?php echo e($reg->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class=" mb-3 mr-2">
            <select  wire:model="filters.city" class="form-control">
                <option disabled value=""><?php echo e(__('edits.select_cities')); ?></option>
                <option  value=""><?php echo e(__('tables.all_cities')); ?></option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php echo e($cit->id == $filters['city']?"selected":""); ?> value="<?php echo e($cit->id); ?>"><?php echo e($cit->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class=" mb-3 mr-2">
            <select name="" class="form-control rounded-md " id="">
                <option value=""><?php echo e(__('edits.status')); ?></option>
            </select>
        </div>

        <div class=" mb-3 mr-2">
            <div class="">
                <input type="text" wire:model.debounce.500ms="filters.name" class="form-control  w-100  input-sm"
                       placeholder="<?php echo e(__('tables.search')); ?>">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('common.name')); ?></th>
                <th><?php echo e(__('common.phone')); ?></th>
                <th><?php echo e(__('common.email')); ?></th>
                <th>Role</th>
                <th><?php echo e(__('common.region')); ?></th>
                <th><?php echo e(__('common.city')); ?></th>
                <th><?php echo e(__('edits.joined_on')); ?></th>
                <th><?php echo e(__('edits.status')); ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($loop->index + 1); ?></td>
                    <td>
                        <?php echo e($user->name); ?>

                    </td>
                    <td>
                        <?php echo e($user->phone); ?>

                    </td>
                    <td><?php echo e($user->email); ?> </td>
                    <td><?php echo e($user->role); ?> </td>
                    <td>
                        <?php echo e(isset($user->region)?$user->region->name:""); ?>

                    </td>
                    <td>
                        <?php echo e(isset($user->city)?$user->city->city:""); ?>

                    </td>
                    <td><?php echo e($user->created_at); ?> </td>
                    <td class="p-2">
                        <div class=" p-2 rounded-lg badge badge-<?php echo e($user->status == '1' ? 'success' : 'processing'); ?>">
                            <?php echo e($user->status == '1' ? 'Active' : 'Inactive'); ?>

                        </div>
                         </td>
                    <td>
                        <div class="d-flex">
                            <div class="button-list">
                                <a href="<?php echo e(route('user.detail', $user)); ?>" class="btn btn-primary"><i
                                    class="fa fa-eye"></i> </a>
                            </div>
                            <div class="button-list ml-1">
                                <a href="#" wire:click.prevent="$emitTo('admin.users.delete','load',<?php echo e($user); ?>)" class="btn btn-danger "><i
                                    class="fa fa-trash"></i> </a>
                            </div>
                        </div>
                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class=" text-center"><?php echo e(__('tables.no_entry')); ?></td>
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
    $html = \Livewire\Livewire::mount('admin.users.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l28009347-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l28009347-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l28009347-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l28009347-0');
} else {
    $response = \Livewire\Livewire::mount('admin.users.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l28009347-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>   
</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/users/index.blade.php ENDPATH**/ ?>