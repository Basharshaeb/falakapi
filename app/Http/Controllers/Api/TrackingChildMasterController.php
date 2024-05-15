<?php

namespace App\Http\Controllers\Api;

use App\Models\TrackingChildMaster;
use Illuminate\Http\Request;
use App\Http\Requests\TrackingChildMasterRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TrackingChildMasterResource;

class TrackingChildMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trackingChildMasters = TrackingChildMaster::paginate();

        return TrackingChildMasterResource::collection($trackingChildMasters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrackingChildMasterRequest $request): TrackingChildMaster
    {
        return TrackingChildMaster::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(TrackingChildMaster $trackingChildMaster): TrackingChildMaster
    {
        return $trackingChildMaster;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrackingChildMasterRequest $request, TrackingChildMaster $trackingChildMaster): TrackingChildMaster
    {
        $trackingChildMaster->update($request->validated());

        return $trackingChildMaster;
    }

    public function destroy(TrackingChildMaster $trackingChildMaster): Response
    {
        $trackingChildMaster->delete();

        return response()->noContent();
    }
}
