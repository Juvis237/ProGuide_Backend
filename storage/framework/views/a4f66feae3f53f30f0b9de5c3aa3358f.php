<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Delivrable Details</h3>
            </div>
            <div>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',<?php echo e($school); ?>, <?php echo e($delivrable); ?>)" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Edit Delivrable
                </a>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.modes.edit','load',<?php echo e($delivrable); ?>)" class="btn btn-secondary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Add Mode
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               <?php echo e($delivrable->name); ?>

           </h4>
       </div>
       <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delivrable.modes.index', ['delivrable' => $delivrable])->html();
} elseif ($_instance->childHasBeenRendered('l2316125062-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2316125062-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2316125062-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2316125062-0');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delivrable.modes.index', ['delivrable' => $delivrable]);
    $html = $response->html();
    $_instance->logRenderedChild('l2316125062-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>


    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delivrable.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l2316125062-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l2316125062-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2316125062-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2316125062-1');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delivrable.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l2316125062-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
   
</div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/school/delivrable/details.blade.php ENDPATH**/ ?>