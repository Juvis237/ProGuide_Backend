<form x-data="{ isModalOpen : <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }" wire:submit.prevent="save">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e($isEditMode?  __('edits.edit_testimonial') : __('edits.add_testimonial')); ?></h5>
            </div>
            <div class="modal-body row">
                <div class=" form-group col-12">
                    <label><?php echo e(__('common.name')); ?><span class="text-danger">*</span></label>
                    <input type="text" wire:model="name" class="form-control">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class=" form-group col-12">
                    <label><?php echo e(__('edits.company')); ?><span class="text-danger">*</span></label>
                    <input type="text" wire:model="company" class="form-control">
                    <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class=" form-group col-12">
                    <label><?php echo e(__('admin.testimonial')); ?><span class="text-danger">*</span></label>
                    <textarea type="text" wire:model="testimony" class="form-control"></textarea>
                    <?php $__errorArgs = ['testimony'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class=" form-group col-12">
                    <label><?php echo e(__('edits.cover_image')); ?><span class="text-danger">*</span></label>
                    <div class="row">
                        <?php if(isset($image)): ?>
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="<?php echo e($image->temporaryUrl()); ?>" >
                            </div>
                        <?php endif; ?>

                        <?php if($isEditMode && !isset($image)): ?>
                            <div class="col-3 card mx-1 mb-1">
                                <img class="img-fluid p-2" src="<?php echo e($testimonial->coverImage()); ?>" >
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('edits.select_image')); ?></label>
                        <input type="file" class="form-control" wire:model="image">
                        <div wire:loading wire:target="image">Uploading ...</div>
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                </button>
                <button type="button" wire:click="save" class="btn btn-primary"  wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    <?php echo e(__('edits.save_changes')); ?>

                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/testimonial/edit.blade.php ENDPATH**/ ?>