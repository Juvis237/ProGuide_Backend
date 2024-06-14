<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DelivrableResource;
use App\Http\Resources\ModeResource;
use App\Http\Resources\RequestResource;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\UserResource;
use App\Models\Delivrable;
use App\Models\User;
use App\Notifications\StatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as UserRequest;
use App\Models\School;

class RequestController extends Controller
{
    public User $user;

    public function __construct(){
        $this->user = Auth::guard('api')->user();
    }


    /**
     * GET SCHOOLS
     * Endpoint to get  all the schools available.
     *@request /schools
     *@method GET

     */

     public function getSchools(Request $request)
     { 
         return response([
             'success' => true,
             'schools' => SchoolResource::collection(School::all()),
         ]);
     }

    /**
     * GET DELIVRABLES
     * Endpoint to get  all the Delivrables of a particular school.
     * @queryParam school_id required  Delivrable School,
    *@request /delivrables?school_id=SCHOOL_ID
     *@method GET

     */

     public function getDelivrables(Request $request)
     { 
         return response([
             'success' => true,
             'delivrables' => DelivrableResource::collection(School::find($request->school_id)->delivrables),
         ]);
     }

    /**
     * GET DELIVRABLES
     * Endpoint to get  all the Modes of a particular Delivrable.
     * @queryParam delivrable_id required  Delivrable Modes,
     *@request /modes?delivrable_id=DELIVRABLE
     *@method GET

     */

     public function getModes(Request $request)
     { 
         return response([
             'success' => true,
             'modes' => ModeResource::collection(Delivrable::find($request->delivrable_id)->modes),
         ]);
     }

    /**
     * GET REQUESTS
     * Endpoint to get  all requests sent by the current logged in user.
     * You can filter by status
     *  @queryParam status nullable  Request Status,
     *@request /requests?status=STATUS
     *@method GET

     */

    public function getRequests(Request $request)
    {
        if($this->user->isAgent()){
            $req = UserRequest::where('assigned_to', $this->user->id);
        }else {
            $req = $this->user->requests();
        }
        
        if ($request->status) {
            $req = $req->whereStatus($request->status);
        }

        return response([
            'success' => true,
            'requests' => RequestResource::collection($req->get()),
        ]);
    }

    /**
     * ADD REQUEST
     * Endpoint to create a new request for a user
     *
     * @queryParam delivrable_id required  Request Title
     * @queryParam mode_id nullable  Request Description
     * @queryParam date date|after:now  Requests Desired Date Of Completion
     *@request /requests/add_request?title=TITLE&description=DESCRIPTION
     *@method POST

     */
    public function addRequest(Request $request){
        $validated = Validator::make($request->all(), [
            "delivrable_id" => 'required',
            "mode_id" => "nullable",
            "date" => "date|after:now",
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }


        $req = \App\Models\Request::create([
            'user_id' => $this->user->id,
            'delivrable_id' => $request->delivrable_id,
            'mode_id' => $request->mode_id,
            'date' => $request->date,
            'status' => \App\Models\Request::STATUS_PENDING,
        ]);


        return response([
            'success' => true,
            'request' => new RequestResource($req),
        ]);

    }

    /**
     * Update REQUEST
     * Endpoint to update a request from a user
     * 
     * @queryParam request_id required  RequestID
     * @queryParam delivrable_id nullable  Delivrable ID
     * @queryParam mode_id nullable  Mode ID
     * @queryParam date date|after:now nullable  Requests Desired Date Of Completion
     *@request /requests/update_request?request_id=REQUESTID&delivrable_id=ID&mode_id=MODE
     *@method POST

     */
    public function updateRequest(Request $request){
        $validated = Validator::make($request->all(),[
            "request_id" => 'required',
        ]);

        if ($validated->fails()) {
                return response(['success'=>false,
                    'message' => $validated->errors()->first()
                ]);
        }

        $req = \App\Models\Request::find($request->request_id);

        if ($req->status != \App\Models\Request::STATUS_DRAFT){
                return response(['success'=>false,
                'message' => 'The request cannot be updated because it is not in draft'
            ]);
        }

        $req->update([
            'delivrable_id' => isset($request->delivrable_id)? $request->delivrable_id : $req->delivrable_id,
            'mode_id' => isset($request->mode_id)? $request->mode_id : $req->mode_id,
            'date' => isset($request->date)? $request->date : $req->date,
        ]);


        return response([
            'success' => true,
            'request' => new RequestResource($req),
        ]);
    }

    /**
     * UPDATE REQUEST STATUS
     * Endpoint to update the status of a user's request
     *
     * @queryParam request_id required  Request ID
     * @queryParam status required New Request Status in ['pending', 'completed', 'cancelled']
     * @request /requests/update_status?request_id=REQUESTID&status=STATUS
     * @method POST
     */

    public function sendRequest(Request $request, $id)
    {
        $req = \App\Models\Request::find($id);


        if (in_array($req->status, \App\Models\Request::STATUS)) {
            $req->update([
                'status' => $request->status
            ]);

            $admins = User::where('admin', '1')->get();
            $link = route('requests.detail', $req);
            $details['greeting'] = 'Hi,';
            $details['subject'] = 'New Request from user';
            $details['body'] = "<p>you have a new request from $req->user->first_name   </p>
                                <p>Title :   $req->title </p>
                                <p>Description :   $req->description </p>
                            <p>Click <a href = '$link'>here</a> to know more</p>";
            try {
                Notification::send($admins, new StatusUpdated($details));
            } catch (\Exception $e) {

            }
            return response([
                'success' => true,
                'message' => "Request updated",
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'Status is not valid',
            ]);
        }

    }

    /**
     * DELETE REQUEST
     * Endpoint to delete a users request
     *
     * @queryParam request_id required  Request ID
     * @request /requests/delete_request?request_id=REQUESTID
     * @method POST
     */
    public function deleteRequest($id)
    {
        $req = \App\Models\Request::find($id);

        if (!in_array($req->status, [\App\Models\Request::STATUS_DRAFT, \App\Models\Request::STATUS_PENDING])) {
            return response([
                'success' => false,
                'message' => 'The request status does not permit deletion'
            ]);
        }
        $req->delete();
        $reqs = $this->user->requests;
        return response([
            'success' => true,
            'message' => 'The request has been deleted successfully'
        ]);
    }


    /**
     *find professionals
     * @method POST
     */
    public function search(Request $request)
    {
        $users = new User();

        $users = $users->where('role', "worker")->get();
        return response([ 'success' => true,'data'=>$request->all(), 'result' => \App\Http\Resources\ProfessionalResource::collection($users)], 200);
    }

        /**
     * DELETE REQUEST
     * Endpoint to delete a users request
     *
     * @queryParam request_id required  Request ID
     * @queryParam rating required  Request Rating
     * @queryParam comment nullable  Request Comment ID
     * @request /rate_request?request_id=REQUESTID&rating=REQUESTID&comment=REQUEST
     * @method POST
     */
    public function rateRequest(Request $request) {
       
        $user_request = UserRequest::findOrFail((int)$request->input('id'));

        $user_request->rating = (int)$request->input('rating');
        $user_request->comment = $request->input('comment');

        $user_request->save();
        $requests = $this->user->requests();
        return response()->json(['requests' => RequestResource::collection($requests->get()), 'status' => 200]);
    }
}
