<div>
    <h5>User Profile</h5>

    <div class="d-flex align-items-center g-3 py-5">
        <?php if(!isset($profile_picture)): ?>
            <img class="bg-white img-fluid p-4 me-5 border signature-image" style="max-width:  150px"
                 src="<?php echo e(asset('storage/'.$user->profile)); ?>">


        <?php else: ?>
            <img class="bg-white img-fluid p-4 me-5 border signature-image"  style="max-width:  150px"
                 src="<?php echo e($profile_picture->temporaryUrl()); ?>">

        <?php endif; ?>

        <label for="profile" class="rounded-sm border border-primary p-2 mx-4 text-primary border-black "><i class="fa fa-upload"></i>Upload Profile Photo</label>
        <input type="file" class="d-none" wire:model='profile_picture' id="profile">
    </div>

    <div class="">
        <div class="form-group">
            <label class="font-15" for="">Full Name <span class="required-field">*</span></label>
            <input type="text" wire:model="title" class="form-control" >
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="row py-5">
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Phone<span class="required-field">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                src="<?php echo e(asset('assets/icons/icons8_usa 1.png')); ?>" alt=""></div>
                    </div>
                    <input type="tel" wire:model="phone" class="form-control bl-none">
                </div>
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
        <div class="col-lg-6 mt-3">
            <div class="form-group">
                <label class="font-15" for="">Email<span class="required-field">*</span></label>
                <input readonly wire:model="email" type="text" class="form-control">
            </div>
        </div>
    </div>


    <button type="button" class="btn bt-sm btn-primary border-0 mt-5" wire:click = 'update'>
        Save Changes
    </button>

</div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/update-profile.blade.php ENDPATH**/ ?>