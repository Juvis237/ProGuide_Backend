<div>
    <h4><?php echo e($user->role=="client"?"User":"Business"); ?> Details</h4>
    <div class="row mt-2">
        <div class="col-12 col-lg-4 ">
            <div class="row d-flex align-items-center py-4 px-2 bg-white rounded-lg shadow-sm mx-2">
                <div class=" col-12 col-md-4">
                        <img class="bg-white  signature-image" style="max-width:  100px"
                        src="<?php echo e(!isset($user->profile)?  asset('be_assets/images/Frame 75.png') : asset('storage/'.$user->profile)); ?>">
                </div>
                <div class="col-12 col-md-6">
                    <span>
                        <h4><?php echo e($user->first_name); ?></h4>
                        <li class="text-primary font-weight-bold"><?php echo e(ucfirst($user->role)); ?></li>
                        <div class="d-flex mt-2">
                            <a class="btn border border-primary rounded  text-primary <?php echo e($user->role == 'client'? 'd-none' : ''); ?>" href="<?php echo e(route('edit.user', ['user' => $user->id])); ?>">
                                <?php echo e(__('edits.edit')); ?> 
                            </a>
                            <button class="mx-1 btn btn-warning " wire:click.prevent="$emitTo('admin.users.suspend','load',<?php echo e($user); ?>)">
                                <?php echo e($user->status != 2? 'Suspend' : 'Unsuspend'); ?>

                            </button>
                            <button class="btn btn-danger ms-2 <?php echo e($user->role == 'client'? 'd-none' : ''); ?>" wire:click.prevent="$emitTo('admin.users.delete','load',<?php echo e($user); ?>)">
                                <?php echo e(__('edits.delete')); ?> 
                            </button>
                        </div>

                    </span>
                </div>
                <div class="col-12 my-2">
                    <span>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('edits.status')); ?> </p>
                            <div class=" p-2 mx-2 rounded-lg badge badge-<?php echo e($user->status == '1' ? 'success' : 'processing'); ?>" style="margin-top: -5px">
                                <?php echo e($user->status == '1' ? 'Active' : 'Inactive'); ?>

                            </div>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('common.email')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->email); ?></p>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('common.phone')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->phone); ?></p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Address :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->address); ?></p>
                        </div>

                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('edits.joined_on')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->created_at); ?></p>
                        </div>
                        
                    </span>

                    <div class="<?php echo e($user->role == 'client'? 'd-none': ''); ?> pt-4 border-top">
                        <h4>Businness Information</h4>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('edits.company')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->company_name); ?></p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark">Bio :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->bio); ?></p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('edits.location')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->address); ?></p>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="font-weight-bold font-16 text-dark"><?php echo e(__('edits.website')); ?>  :</p>
                            <p class="font-16 mx-2 text-dark"><?php echo e($user->website); ?></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-12 col-lg-8   py-4 px-2 bg-white rounded-lg shadow-sm">
            <div class="d-flex overflow-auto">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('user.detail', ['user' => $user, 'tab' => $loop->index])); ?>" class="hover-overlay text-dark">
                        <div class="px-4 py-1 d-flex align-items-center <?php echo e($tab == $loop->index? 'border-bottom  border-primary' : ''); ?> ">
                            <p class="font-weight-bold <?php echo e($tab == $loop->index? 'text-primary' : ''); ?> font-16 "><?php echo e($menu); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div>

        </div>
    </div>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.suspend', [])->html();
} elseif ($_instance->childHasBeenRendered('l3974586540-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3974586540-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3974586540-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3974586540-0');
} else {
    $response = \Livewire\Livewire::mount('admin.users.suspend', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3974586540-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.delete', [])->html();
} elseif ($_instance->childHasBeenRendered('l3974586540-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3974586540-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3974586540-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3974586540-1');
} else {
    $response = \Livewire\Livewire::mount('admin.users.delete', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3974586540-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>

<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/users/detail.blade.php ENDPATH**/ ?>