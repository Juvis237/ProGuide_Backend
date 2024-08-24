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
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('edits.delete_testimonial')); ?></h5>
            </div>
            <div class="modal-body ">
                <p class="text-center"> <?php echo e(__('edits.other_deletes')); ?> ?</p>
                <?php if(isset($testimonial)): ?>
                    <p class="text-center"> <?php echo e(__('common.name')); ?> : <span><?php echo e($testimonial->name); ?></span></p>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                </button>
                <button type="button" wire:click="delete" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="delete"></i>
                    <?php echo e(__('edits.delete')); ?>

                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/testimonial/delete.blade.php ENDPATH**/ ?>