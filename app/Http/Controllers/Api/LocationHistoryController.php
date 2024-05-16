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

class LocationHistoryController extends Controller
{
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
    public function store(LocationHistoryRequest $request): LocationHistory
    {
        $user=User::find(Auth::user()->id);
        if($user){
        $user->latitude= $request->latitude;
        $user->longitude= $request->longitude;
        $user->save();
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
