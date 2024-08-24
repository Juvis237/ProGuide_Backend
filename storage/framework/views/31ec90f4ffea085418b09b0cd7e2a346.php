<form x-data="{ isModalOpen: <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }" wire:submit.prevent="save">
    <div class="modal" role="dialog" tabindex="-1" x-show="isModalOpen" x-cloak x-transition>
        <div class="modal-inner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('edits.edit')); ?></h5>
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
                    <label><?php echo e(__('tables.title')); ?><span class="text-danger">*</span></label>
                    <input type="text" wire:model="title" class="form-control">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"> <?php echo e($message); ?> </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <div class=" form-group col-12">
                    <label><?php echo e(__('edits.content')); ?><span class="text-danger">*</span></label>
                    <?php if (isset($component)) { $__componentOriginal7c6180b19be4f1691096406ffdcb7998 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c6180b19be4f1691096406ffdcb7998 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wysiwyg','data' => ['wire:model' => 'description','wire:key' => 'uniqueKey','id' => 'description','class' => 'description form-input rounded-md shadow-sm mt-1 block w-full','rows' => '20','autocomplete' => 'description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('wysiwyg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'description','wire:key' => 'uniqueKey','id' => 'description','class' => 'description form-input rounded-md shadow-sm mt-1 block w-full','rows' => '20','autocomplete' => 'description']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c6180b19be4f1691096406ffdcb7998)): ?>
<?php $attributes = $__attributesOriginal7c6180b19be4f1691096406ffdcb7998; ?>
<?php unset($__attributesOriginal7c6180b19be4f1691096406ffdcb7998); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c6180b19be4f1691096406ffdcb7998)): ?>
<?php $component = $__componentOriginal7c6180b19be4f1691096406ffdcb7998; ?>
<?php unset($__componentOriginal7c6180b19be4f1691096406ffdcb7998); ?>
<?php endif; ?>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"> <?php echo e($message); ?> </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>



            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                    data-dismiss="modal"><?php echo e(__('edits.close')); ?>

                </button>
                <button type="button" wire:click="save" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none" wire:target="save"></i>
                    <?php echo e(__('edits.save_changes')); ?>

                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/pages/edit.blade.php ENDPATH**/ ?>