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
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e($isEditMode?  __('edits.edit')."FAQ" : __('edits.create')."FAQ"); ?></h5>
            </div>
            <div class="mb-3 text-right <?php echo e(!$isEditMode ? 'd-none' : ''); ?>">
                <div class="edit-lang-options">
                    <a href="#" wire:click.prevent = "setLang('en')"
                       class="<?php echo e($lang == 'en' ? 'bg-secondary rounded p-2 text-white' : ''); ?> "><?php echo e(__('edits.edit_english')); ?></a>
                    <a href="#" wire:click.prevent = "setLang('fr')"
                       class="<?php echo e($lang == 'fr' ? 'bg-secondary rounded p-2 text-white' : ''); ?>"><?php echo e(__('edits.edit_french')); ?></a>
                </div>
            </div>
            <div class="modal-body row">

                <div class=" form-group col-12">
                    <label>Category<span class="text-danger">*</span></label>
                    <select wire:model="category_id" class="form-control">
                        <option disabled value=""><?php echo e(__('tables.all_categories')); ?></option>
                        <option  value=""><?php echo e(__('tables.all_categories')); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e(ucfirst($category->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class=" form-group col-12">
                    <label><?php echo e(__('tables.question')); ?><span class="text-danger">*</span></label>
                    <input type="text" wire:model="question" class="form-control">
                    <?php $__errorArgs = ['question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>



                <div class=" form-group col-12">
                    <label><?php echo e(__('edits.content')); ?><span class="text-danger">*</span></label>
                    <textarea type="text" wire:model="answer" class="form-control"></textarea>
                    <?php $__errorArgs = ['answer'];
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
                <button type="button" wire:click="save" class="btn btn-primary"  wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    <?php echo e(__('edits.save_changes')); ?>


                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/faq/edit.blade.php ENDPATH**/ ?>