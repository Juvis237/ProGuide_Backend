<div>
    <h4><?php echo e(__('admin.add_business')); ?></h4>

    <div class="mt-4 p-4 rounded-lg bg-white">
        <div class="row ">
            <h5 class="pb-5 col-12"><?php echo e(__('edits.business_contact')); ?></h5>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.first_name')); ?> <span class="required-field">*</span></label>
                    <input type="text" wire:model="first_name" class="form-control" >
                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.last_name')); ?> <span class="required-field">*</span></label>
                    <input type="text" wire:model="last_name" class="form-control" >
                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.email')); ?> <span class="required-field">*</span></label>
                    <input type="email" wire:model="email" class="form-control" >
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.phone')); ?> <span class="required-field">*</span></label>
                    <input type="text" wire:model="phone" class="form-control" >
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label class="font-15" for=""><?php echo e(__('common.password')); ?> <span class="required-field">*</span></label>
                    <div class="input-group">
                        <input type="text" <?php echo e($isEditMode ? 'disabled' : ''); ?> wire:model="password" class="form-control bl-none">
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-start">
                <button class="rounded-lg bg-white border border-primary p-2 mt-3  text-primary border-black " <?php echo e($isEditMode ? 'disabled' : ''); ?> wire:click='generate' wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="generate"></i>
                    <i class="fa fa-lock"></i> <?php echo e(__('edits.generate')); ?> </button>
            </div>


                <div class=" col-12 d-flex align-items-center">
                    <h6 class="me-2"><?php echo e(__('edits.status')); ?>  : </h6>
                    <div style="width: 5px"></div>
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'status' role="switch" id="flexSwitchCheckChecked" >
                        <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo e($status == 0 ? 'Inactive' : 'Active'); ?></label>
                    </div>
                </div>

                <div class=" col-12 mt-4 d-flex align-items-center">
                    <div class="form-check form-switch ">
                        <input class="form-check-input ms-2" type="checkbox" wire:model = 'check' role="switch" id="emailcount" checked >
                        <label class="form-check-label" for="emailcount"><?php echo e(__('edits.send_account')); ?> </label>
                    </div>
                </div>



        </div>
    </div>

    <div class="mt-4 p-4  rounded-lg bg-white">
        <h5 class="pb-5 col-12"><?php echo e(__('edits.business_info')); ?></h5>
        <div class="col-12">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('edits.company')); ?> <span class="required-field">*</span></label>
                <input type="text" wire:model="company" class="form-control" >
                <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for="">Address <span class="required-field">*</span></label>
                <input type="text" wire:model="address" class="form-control" >
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.region')); ?> <span class="required-field">*</span></label>
            <select  wire:model="region_id" wire:change='set_cities'  class="form-control">
                <option value=""><?php echo e(__('edits.select_region')); ?></option>
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option  value="<?php echo e($reg->id); ?>"><?php echo e($reg->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-12 col-lg-6">
            <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('common.city')); ?> <span class="required-field">*</span></label>
            <select  wire:model="city_id" class="form-control">
                <option value=""><?php echo e(__('edits.select_city')); ?></option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cit->id); ?>"><?php echo e($cit->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="col-12 ">
            <div class="form-group">
                <label class="font-15 font-weight-bold text-dark" for=""><?php echo e(__('edits.website')); ?> <span class="required-field">*</span></label>
                <input type="text" wire:model="website" class="form-control" >
                <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <button type="button" class="btn bt-sm btn-primary border-0 mt-5" <?php echo e($saved? 'disabled' : ''); ?> wire:click = 'save'>
        <?php echo e($isEditMode ? __('edits.update_business') : __('edits.create_business')); ?>

    </button>

</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/users/edit.blade.php ENDPATH**/ ?>