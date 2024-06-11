<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">School Details</h3>
            </div>
            <div>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.edit','load',<?php echo e($school); ?>)" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Edit school
                </a>
                <a href="#"  wire:click.prevent="$emitTo('admin.school.delivrable.edit','load',<?php echo e($school); ?>)" class="btn btn-secondary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="save"></i>
                    Add Delivrable
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5">
       <div class="mb-4">
           <h4>
               <?php echo e($school->name); ?>

           </h4>
       </div>
       <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delivrable.index', ['school' => $school])->html();
} elseif ($_instance->childHasBeenRendered('l3492979258-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3492979258-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3492979258-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3492979258-0');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delivrable.index', ['school' => $school]);
    $html = $response->html();
    $_instance->logRenderedChild('l3492979258-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>


    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l3492979258-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3492979258-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3492979258-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3492979258-1');
} else {
    $response = \Livewire\Livewire::mount('admin.school.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3492979258-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.school.delivrable.edit', [])->html();
} elseif ($_instance->childHasBeenRendered('l3492979258-2')) {
    $componentId = $_instance->getRenderedChildComponentId('l3492979258-2');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3492979258-2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3492979258-2');
} else {
    $response = \Livewire\Livewire::mount('admin.school.delivrable.edit', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3492979258-2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>
<?php /**PATH /Users/ivanotechs/Documents/ProGuide/proguide_be/resources/views/livewire/admin/school/details.blade.php ENDPATH**/ ?>