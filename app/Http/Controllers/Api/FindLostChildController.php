<?php

namespace App\Http\Controllers\Api;

use App\Models\FindLostChild;
use Illuminate\Http\Request;
use App\Http\Requests\FindLostChildRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FindLostChildResource;

class FindLostChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $findLostChildren = FindLostChild::paginate();

        return FindLostChildResource::collection($findLostChildren);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FindLostChildRequest $request): FindLostChild
    {
        return FindLostChild::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(FindLostChild $findLostChild): FindLostChild
    {
        return $findLostChild;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FindLostChildRequest $request, FindLostChild $findLostChild): FindLostChild
    {
        $findLostChild->update($request->validated());

        return $findLostChild;
    }

    public function destroy(FindLostChild $findLostChild): Response
    {
        $findLostChild->delete();

        return response()->noContent();
    }
}
