<div>
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
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e($isEditMode?  __('edits.edit_category') : __('edits.add_category')); ?></h5>
                </div>

                <div class=" form-group col-12">
                    <label><?php echo e(__('edits.type')); ?><span class="text-danger">*</span></label>
                    <select disabled wire:model="type" class="form-control">
                        <option <?php echo e($type == "faq"?"selected":""); ?> value="faq">FAQ</option>
                        <option <?php echo e($type == "blog"?"selected":""); ?> value="blog">Blog</option>
                    </select>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                </div>

                <div class="modal-footer">
                    <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                    </button>
                    <button type="button" wire:click="save" class="btn btn-primary" wire:loading.attribute="disabled" wire:target="save">
                        <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                        <?php echo e(__('edits.save_changes')); ?>

                    </button>


                </div>
            </div>
        </div>

        <div class="overlay" x-show="isModalOpen" x-cloak></div>
    </form>

</div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/categories/edit.blade.php ENDPATH**/ ?>