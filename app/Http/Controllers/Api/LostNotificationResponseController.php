<?php

namespace App\Http\Controllers\Api;

use App\Models\LostNotificationResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LostNotificationResponseRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LostNotificationResponseResource;

class LostNotificationResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lostNotificationResponses = LostNotificationResponse::paginate();

        return LostNotificationResponseResource::collection($lostNotificationResponses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LostNotificationResponseRequest $request): LostNotificationResponse
    {
        return LostNotificationResponse::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(LostNotificationResponse $lostNotificationResponse): LostNotificationResponse
    {
        return $lostNotificationResponse;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LostNotificationResponseRequest $request, LostNotificationResponse $lostNotificationResponse): LostNotificationResponse
    {
        $lostNotificationResponse->update($request->validated());

        return $lostNotificationResponse;
    }

    public function destroy(LostNotificationResponse $lostNotificationResponse): Response
    {
        $lostNotificationResponse->delete();

        return response()->noContent();
    }
}
