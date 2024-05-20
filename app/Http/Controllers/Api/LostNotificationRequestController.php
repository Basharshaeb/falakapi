<?php

namespace App\Http\Controllers\Api;

use App\Models\LostNotificationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LostNotificationRequestRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LostNotificationRequestResource;
use App\Models\LostNotificationResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
class LostNotificationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data['data']
        $lost = LostNotificationRequest::where('user_id',Auth::user()->id)->where('notification_status','!=','Received')->paginate();
$data['responses']=LostNotificationResponse::with('user')->whereIn('request_id',$lost->pluck('id')->toArray())->get();
        $data['data']=$lost;

return response()->json($data);
// return LostNotificationRequestResource::collection($data);
    }

    public function getByLocation(Request $request)
    {
        // $lostNotificationRequests = LostNotificationRequest::where('user_id',Auth::user()->id)->paginate();

        // $user = Auth::user();
        // $userLatitude = $user->latitude;
        // $userLongitude = $user->longitude;

        // // Define the distance in kilometers (e.g., within 10 kilometers)
        // $distance = 10;

        // // Haversine formula to calculate distance in MySQL
        // $lostNotificationRequests = LostNotificationRequest::selectRaw("*,
        //     ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
        //     * cos( radians( longitude ) - radians(?) )
        //     + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance",
        //     [$userLatitude, $userLongitude, $userLatitude])
        //     ->having('distance', '<', $distance)
        //     ->orderBy('distance')
        //     ->paginate();
        $user = Auth::user();
        $userLatitude = $user->latitude;
        $userLongitude = $user->longitude;

        // Define the distance in kilometers (e.g., within 10 kilometers)
        $distance = 10;

        // Fetch all LostNotificationRequests
        $lostNotificationRequests = LostNotificationRequest::where('user_id','!=',$user->id)->get();

        // Filter the records based on the calculated distance
        $nearbyRequests = $lostNotificationRequests->filter(function ($request) use ($userLatitude, $userLongitude, $distance) {
            $requestDistance = $this->calculateDistance($userLatitude, $userLongitude, $request->latitude, $request->longitude);
            return $requestDistance <= $distance;
        });

        // Paginate the results manually
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $paginatedResults = new LengthAwarePaginator(
            $nearbyRequests->forPage($page, $perPage),
            $nearbyRequests->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return LostNotificationRequestResource::collection($lostNotificationRequests);
    }

    public function getNearbyResponse(Request $request)
    {
        // $lostNotificationRequests = LostNotificationRequest::where('user_id',Auth::user()->id)->paginate();

        // $user = Auth::user();
        // $userLatitude = $user->latitude;
        // $userLongitude = $user->longitude;

        // // Define the distance in kilometers (e.g., within 10 kilometers)
        // $distance = 10;

        // // Haversine formula to calculate distance in MySQL
        // $lostNotificationRequests = LostNotificationRequest::selectRaw("*,
        //     ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
        //     * cos( radians( longitude ) - radians(?) )
        //     + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance",
        //     [$userLatitude, $userLongitude, $userLatitude])
        //     ->having('distance', '<', $distance)
        //     ->orderBy('distance')
        //     ->paginate();
        $user = Auth::user();
        $userLatitude = $user->latitude;
        $userLongitude = $user->longitude;

        // Define the distance in kilometers (e.g., within 10 kilometers)
        $distance = 10;

        // Fetch all LostNotificationRequests
        $lostNotificationRequests = LostNotificationResponse::where('user_id','!=',$user->id)->get();

        // Filter the records based on the calculated distance
        $nearbyRequests = $lostNotificationRequests->filter(function ($request) use ($userLatitude, $userLongitude, $distance) {
            $requestDistance = $this->calculateDistance($userLatitude, $userLongitude, $request->latitude, $request->longitude);
            return $requestDistance <= $distance;
        });

        // Paginate the results manually
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $paginatedResults = new LengthAwarePaginator(
            $nearbyRequests->forPage($page, $perPage),
            $nearbyRequests->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return LostNotificationRequestResource::collection($lostNotificationRequests);
    }
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

        return $earthRadiusKm * $c;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(LostNotificationRequestRequest $request): LostNotificationRequest
    {
$user=Auth::user();
        return LostNotificationRequest::create(array_merge($request->validated(),['user_id'=>Auth::user()->id,
    'longitude'=>$user->longitude,'latitude'=>$user->latitude,'notification_status'=>'not Found']));
    }

    /**
     * Display the specified resource.
     */
    public function show(LostNotificationRequest $lostNotificationRequest): LostNotificationRequest
    {
        return $lostNotificationRequest;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LostNotificationRequestRequest $request, LostNotificationRequest $lostNotificationRequest): LostNotificationRequest
    {
        $lostNotificationRequest->update($request->validated());

        return $lostNotificationRequest;
    }

    public function destroy(LostNotificationRequest $lostNotificationRequest): Response
    {
        $lostNotificationRequest->delete();

        return response()->noContent();
    }
    public function updateStatus(Request $request)
    {
        $LostNotification=LostNotificationRequest::where('id',$request->id)->get()->first();
        if($LostNotification){
            $LostNotification->notification_status=$request->status;
            $LostNotification->save();
        }
        // $lostNotificationRequest->delete();

        return response()->json($LostNotification);
    }
}
