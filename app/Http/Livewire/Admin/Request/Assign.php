<?php

namespace App\Http\Livewire\Admin\Request;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;
use App\Notifications\StatusUpdated;
use Illuminate\Support\Facades\Notification;

class Assign extends Component
{
    public $showModal = false;
    public Request $request;
    public $assigned_to;
    public $agents;

    protected $listeners = [
        'load'=>'load'
    ];

    /**
     * @param Request $request
     */
    public function mount(){
        $this->agents = User::where('role', 'agent')->get();
    }
    public function load(Request $request){
        $this->request = $request;
        $this->showModal = true;
    }

    public function change(){
        $this->request->assigned_to = $this->assigned_to;
        $this->request->status = 'assigned';
        $this->request->save();

        //Notification to the admin that changed the status
        $target_agent = User::find($this->assigned_to);

        //Notification to the admin that changed the status
        $details['greeting'] = 'Dear '.$target_agent->user_name;
        $details['subject'] = 'Assigned To A Delivery';
        $details['body'] = "<p>You have been assigned to a delivery. Login to your Dashboard for more details </p>";
        try{
            Notification::send($target_agent, new StatusUpdated($details));
        }catch(\Exception $e){
            $this->emit('error', 'An error occured. please try again later');
        }

        //Notification to the user that applied


            $details['greeting'] = 'Hi,';
            $details['subject'] = 'Request Assigned';
            $details['body'] = "<p>Your Request have been assigned to an agent for futher processing  </p>";
            $user = $this->request->user;
            try{
                Notification::send($user, new StatusUpdated($details));
            }catch(\Exception $e){
                $this->emit('error', 'An error occured. please try again later');
            }

        $this->emit("success", "Request Assigned Changed successfully!");
        $this->emit("statusChanged");
        $this->showModal = false;
    }
    

    public function render()
    {
        return view('livewire.admin.request.assign');
    }
}
