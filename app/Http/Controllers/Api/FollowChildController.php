<?php

namespace App\Http\Controllers\Api;

use App\Models\FollowChild;
use Illuminate\Http\Request;
use App\Http\Requests\FollowChildRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FollowChildResource;
use Illuminate\Support\Facades\Auth;

class FollowChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $followChildren = FollowChild::paginate();

        return FollowChildResource::collection($followChildren);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FollowChildRequest $request): FollowChild
    {
        $user_id=Auth::user()->id;
        return FollowChild::create(
            array_merge(
                $request->validated(),
                ['user_id' => $user_id]
            )
           );
    }

    /**
     * Display the specified resource.
     */
    public function show(FollowChild $followChild): FollowChild
    {
        return $followChild;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FollowChildRequest $request, FollowChild $followChild): FollowChild
    {
        $followChild->update($request->validated());

        return $followChild;
    }

    public function destroy(FollowChild $followChild): Response
    {
        $followChild->delete();

        return response()->noContent();
    }
}
