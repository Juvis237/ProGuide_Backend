<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
       aria-expanded="false">
        <i class="mdi mdi-bell text-dark noti-icon"></i>
        
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
        <div class="dropdown-item noti-title">
            <h5 class="font-16 m-0">
                            <span class="float-right">
                            </span>Notification
            </h5>
        </div>
        <div class="slimscroll noti-scroll">
            <?php $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="javascript:void(0);" class="dropdown-item notify-item" wire:click.prevent="mark_as_read(<?php echo e($notification); ?>)">
                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                    <p class="notify-details"><?php echo e($notification->data['title'] ?? ""); ?><small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small></p>
                    <p class="notify-details"><?php echo e(strip_tags($notification->data['content'] )?? ""); ?></p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</li>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/notifications.blade.php ENDPATH**/ ?>