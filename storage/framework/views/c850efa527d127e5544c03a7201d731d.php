<p class="sub-header">
    school Delivrables
    </p>

    <div class="table-responsive">
        <table class="table table-bordered m-0">

            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Number Of Modes</th>
                <th>Duration/days</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $school->delivrables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$del): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr wire:key="<?php echo e($k); ?>">
                    <td><?php echo e($k+1); ?></td>
                    <td><?php echo e($del->name); ?></td>
                    <td><?php echo e($del->price); ?></td>
                    <td><?php echo e($del->modes->count()); ?></td>
                    <td><?php echo e($del->duration); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.delivrable.details', $del)); ?>" class="btn btn-default text-secondary"><i
                            class="fa fa-eye"></i> View</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',<?php echo e($school); ?>, <?php echo e($del); ?>)" class="btn btn-default text-primary"><i class="fa fa-pen"></i> Edit</a>
                        <a href="#" wire:click.prevent="$emitTo('admin.schooldelivrable.delete','load',<?php echo e($del); ?>)" class="btn btn-default text-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/school/delivrable/index.blade.php ENDPATH**/ ?>