<div>
    
    <h5>Change Password</h5>

    <p class="mb-4 col-12 col-lg-8">We suggest if you want to change your password, you choose a strong one. Use 8 or more characters with a mix of letters, numbers and symbols. Must not contain your name or username. </p>

    <div>
        <div class=" form-group col-12 col-md-3">
            <label class="font-15">Enter your current password <span class="text-danger">*</span></label>
            <input type="password"  wire:model = "current_password" class="form-control">
            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div>
        <div class=" form-group col-12 col-md-4 col-lg-3">
            <label class="font-15">New password <span class="text-danger">*</span></label>
            <input type="password" wire:model = "new_password" class="form-control">
            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div>
        <div class=" form-group col-12 col-md-4 col-lg-3 mb-5">
            <label class="font-15">Repeat new password *  <span class="text-danger">*</span></label>
            <input type="password" wire:model = "repeat_password"  class="form-control">
            <?php $__errorArgs = ['repeat_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <button type="button" class="btn bt-sm btn-primary border-0  px-5" wire:click ='save'>
        <i class="fa fa-spinner d-none"></i>
        Change my Password
    </button>

</div>
<?php /**PATH /home/studmtdc/ProGuide_Backend/core/ProGuide_Backend/resources/views/livewire/admin/change-password.blade.php ENDPATH**/ ?>