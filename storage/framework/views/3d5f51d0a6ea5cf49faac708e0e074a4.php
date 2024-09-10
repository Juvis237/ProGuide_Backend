<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Request Details</h3>
            </div>
            <div>
                <a href="#" wire:click.prevent="$emitTo('admin.request.update-status','load',<?php echo e($request); ?>)"
                    class="btn btn-secondary"> Update Status</a>
            </div>
        </div>
    </div>
    <?php
        $application_data = json_decode($request->user_data);
    ?>
    <div class="mt-5">
        <div class="mb-4">
            <h6>User Who Applied</h6>
            <h4>
                <?php echo e($request->user->name); ?>

            </h4>
            <h4 >
                <h6>Request Status :</h6>
                 <div class="badge badge-success">
                    <?php echo e($request->status); ?>

                    </div>
            </h4>
            <h3>Document Details</h3>
            <div class="">
                <p>Document :</p> 
                 <h4><?php echo e(\App\Models\Delivrable::find($application_data->doc_type)->name); ?></h4>
            </div>
            <div class="">
                <p> Mode :</p> 
                 <h4><?php echo e(\App\Models\DelivrableMode::find($application_data->trans_mode)->name); ?></h4>
            </div>

            <div class="">
                <p> School :</p> 
                 <h4><?php echo e(\App\Models\School::find($application_data->my_school)->name); ?></h4>
            </div>

            <div class="">
                <p> Number Of Documents Requested :</p> 
                 <h4><?php echo e($application_data->num_doc); ?></h4>
            </div>
            <div class="">
                <p> Name :</p> 
                 <h4><?php echo e($application_data->name); ?></h4>
            </div>
            <div class="">
                <p> Matricule :</p> 
                 <h4><?php echo e($application_data->matricule); ?></h4>
            </div>
            <div class="">
                <p> Faculty :</p> 
                 <h4><?php echo e($application_data->faculty); ?></h4>
            </div>

            <div class="">
                <p> Department :</p> 
                 <h4><?php echo e($application_data->department); ?></h4>
            </div>

            <div class="">
                <p> Level :</p> 
                 <h4><?php echo e($application_data->level); ?></h4>
            </div>
            <div class="">
                <p> Scan Copy Requested :</p> 
                 <h4><?php echo e(isset($application_data->scan_copy) && $application_data->scan_copy ? 'YES' : 'NO'); ?></h4>
            </div>


        </div>

    </div>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.request.update-status', [])->html();
} elseif ($_instance->childHasBeenRendered('l4179662660-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l4179662660-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l4179662660-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l4179662660-0');
} else {
    $response = \Livewire\Livewire::mount('admin.request.update-status', []);
    $html = $response->html();
    $_instance->logRenderedChild('l4179662660-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div><?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/request/detail.blade.php ENDPATH**/ ?>