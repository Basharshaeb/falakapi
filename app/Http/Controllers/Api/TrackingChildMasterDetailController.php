<?php

namespace App\Http\Controllers\Api;

use App\Models\TrackingChildMasterDetail;
use Illuminate\Http\Request;
use App\Http\Requests\TrackingChildMasterDetailRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TrackingChildMasterDetailResource;

class TrackingChildMasterDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trackingChildMasterDetails = TrackingChildMasterDetail::paginate();

        return TrackingChildMasterDetailResource::collection($trackingChildMasterDetails);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrackingChildMasterDetailRequest $request): TrackingChildMasterDetail
    {
        return TrackingChildMasterDetail::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(TrackingChildMasterDetail $trackingChildMasterDetail): TrackingChildMasterDetail
    {
        return $trackingChildMasterDetail;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrackingChildMasterDetailRequest $request, TrackingChildMasterDetail $trackingChildMasterDetail): TrackingChildMasterDetail
    {
        $trackingChildMasterDetail->update($request->validated());

        return $trackingChildMasterDetail;
    }

    public function destroy(TrackingChildMasterDetail $trackingChildMasterDetail): Response
    {
        $trackingChildMasterDetail->delete();

        return response()->noContent();
    }
}
