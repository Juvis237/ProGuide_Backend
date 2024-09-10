<div>
    <div class="row justify-content-between align-items-center">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-14 mb-0">Request Details</h3>
            </div>
            <div>
                <a href="#" wire:click.prevent="$emitTo('admin.request.update-status','load',{{$request}})"
                    class="btn btn-secondary"> Update Status</a>
            </div>
        </div>
    </div>
    @php
        $application_data = json_decode($request->user_data);
    @endphp
    <div class="mt-5">
        <div class="mb-4">
            <h6>User Who Applied</h6>
            <h4>
                {{$request->user->name}}
            </h4>
            <h4 >
                <h6>Request Status :</h6>
                 <div class="badge badge-success">
                    {{ $request->status }}
                    </div>
            </h4>
            <h3>Document Details</h3>
            <div class="">
                <p>Document :</p> 
                 <h4>{{\App\Models\Delivrable::find($application_data->doc_type)->name  }}</h4>
            </div>
            <div class="">
                <p> Mode :</p> 
                 <h4>{{\App\Models\DelivrableMode::find($application_data->trans_mode)->name }}</h4>
            </div>

            <div class="">
                <p> School :</p> 
                 <h4>{{\App\Models\School::find($application_data->my_school)->name  }}</h4>
            </div>

            <div class="">
                <p> Number Of Documents Requested :</p> 
                 <h4>{{$application_data->num_doc  }}</h4>
            </div>
            <div class="">
                <p> Name :</p> 
                 <h4>{{$application_data->name  }}</h4>
            </div>
            <div class="">
                <p> Matricule :</p> 
                 <h4>{{$application_data->matricule  }}</h4>
            </div>
            <div class="">
                <p> Faculty :</p> 
                 <h4>{{$application_data->faculty  }}</h4>
            </div>

            <div class="">
                <p> Department :</p> 
                 <h4>{{$application_data->department  }}</h4>
            </div>

            <div class="">
                <p> Level :</p> 
                 <h4>{{$application_data->level  }}</h4>
            </div>
            <div class="">
                <p> Scan Copy Requested :</p> 
                 <h4>{{isset($application_data->scan_copy) && $application_data->scan_copy ? 'YES' : 'NO'}}</h4>
            </div>


        </div>

    </div>

    <livewire:admin.request.update-status  />
</div>