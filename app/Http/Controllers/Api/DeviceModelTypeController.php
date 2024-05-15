<?php

namespace App\Http\Controllers\Api;

use App\Models\DeviceModelType;
use Illuminate\Http\Request;
use App\Http\Requests\DeviceModelTypeRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceModelTypeResource;

class DeviceModelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $deviceModelTypes = DeviceModelType::paginate();

        return DeviceModelTypeResource::collection($deviceModelTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceModelTypeRequest $request): DeviceModelType
    {
        return DeviceModelType::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceModelType $deviceModelType): DeviceModelType
    {
        return $deviceModelType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceModelTypeRequest $request, DeviceModelType $deviceModelType): DeviceModelType
    {
        $deviceModelType->update($request->validated());

        return $deviceModelType;
    }

    public function destroy(DeviceModelType $deviceModelType): Response
    {
        $deviceModelType->delete();

        return response()->noContent();
    }
}
