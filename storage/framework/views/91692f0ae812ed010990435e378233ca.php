<form x-data="{ isModalOpen : <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }" wire:submit.prevent="delete">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <?php if(isset($blog)): ?>
        <div class="modal-inner modal-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('edits.update_status')); ?></h5>
            </div>
            <div class="modal-body ">
                 <p class="text-center"> <?php echo e(__('edits.other_deletes')); ?></p>

                 <p class="text-center"> <?php echo e(__('tables.title')); ?> : <span><?php echo e($blog->title); ?></span></p>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                </button>
                <button type="button" wire:click="publish('<?php echo e($blog->status==="published"?"draft":"published"); ?>')" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="publish"></i>
                    <?php echo e($blog->status==="published"? __('edits.unpublish'): __('edits.publish')); ?>

                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/blog/publish.blade.php ENDPATH**/ ?>