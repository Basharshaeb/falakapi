<?php

namespace App\Http\Controllers\Api;

use App\Models\LostNotificationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LostNotificationRequestRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LostNotificationRequestResource;
use Illuminate\Support\Facades\Auth;

class LostNotificationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lostNotificationRequests = LostNotificationRequest::where('user_id',Auth::user()->id)->paginate();

        return LostNotificationRequestResource::collection($lostNotificationRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LostNotificationRequestRequest $request): LostNotificationRequest
    {

        return LostNotificationRequest::create(array_merge($request->validated(),['user_id'=>Auth::user()->id]));
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
}
