<?php

namespace App\Http\Controllers\Api;

use App\Models\LocationHistory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LocationHistoryRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationHistoryResource;
use Illuminate\Support\Facades\Auth;
use App\SendsFcmMessages;
class LocationHistoryController extends Controller
{


    use SendsFcmMessages;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locationHistories = LocationHistory::where('user_id','=',Auth::user()->id)->orderBy('created_at','desc')->paginate();

        return LocationHistoryResource::collection($locationHistories);
    }

    public function getHistoryById(Request $request)
    {

        $locationHistories = LocationHistory::where('user_id','=',$request->id)->orderBy('created_at','desc')->paginate();

        return LocationHistoryResource::collection($locationHistories);
    }

    /**
     * Store a newly created resource in storage.
     */



     private function calculateDistance($lat1, $lon1, $lat2, $lon2)
     {
         $earthRadiusKm = 6371;

         $dLat = deg2rad($lat2 - $lat1);
         $dLon = deg2rad($lon2 - $lon1);

         $lat1 = deg2rad($lat1);
         $lat2 = deg2rad($lat2);

         $a = sin($dLat / 2) * sin($dLat / 2) +
             sin($dLon / 2) * sin($dLon / 2) * cos($lat1) * cos($lat2);
         $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

         $distanceKm = $earthRadiusKm * $c;
         $distanceM = $distanceKm * 1000; // تحويل الكيلومترات إلى أمتار

         return $distanceM;
     }
         public function store(LocationHistoryRequest $request): LocationHistory
    {
        $user=User::find(Auth::user()->id);
        if($user){
        $user->latitude= $request->latitude;
        $user->longitude= $request->longitude;
        $user->save();
        if($user->user_type=='child'){
            $parent=User::find($user->main_person_in_charge_id);
            if($parent){
if(!empty($user->boundry))
{
$distance=$this->calculateDistance($user->latitude, $user->longitude,$parent->latitude,$parent->longitude);

if($distance>$user->boundry){
    $token = $parent->fcm_token;
    $title = 'your child is out range ';
    $body ='';
    $data = $request->input('data', []);
    $result = $this->sendFcmMessageToDevice($token, $title, $body, $data);
}
}
            }
        }
        }
        return LocationHistory::create(array_merge($request->validated(),[
            'user_id'=>Auth::user()->id,
            'date_time'=>\Carbon\Carbon::now(),
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationHistory $locationHistory): LocationHistory
    {
        return $locationHistory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationHistoryRequest $request, LocationHistory $locationHistory): LocationHistory
    {
        $locationHistory->update($request->validated());

        return $locationHistory;
    }

    public function destroy(LocationHistory $locationHistory): Response
    {
        $locationHistory->delete();

        return response()->noContent();
    }
}
