<form x-data="{ isModalOpen : <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }" wire:submit.prevent="delete">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner modal-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Request Status</h5>
            </div>
            <div class="modal-body ">
                 <p class="text-center"> <?php echo e(__('Select The Futur Status Of the Request')); ?>?</p>
                <?php if(isset($request)): ?>
                 <p class="text-center"> Request Name : <span><?php echo e($request->user->name); ?></span></p>
                 <select name="" id="" wire:model='status' class="form-control">
                    <option value="">Select Status</option>
                    <?php $__currentLoopData = \App\Models\Request::STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item); ?>" <?php echo e($request->status == $item? 'selected' : ''); ?>><?php echo e(ucfirst($item)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                </button>
                <button type="button" wire:click="change" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="change"></i>
                    Update
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/request/update-status.blade.php ENDPATH**/ ?>