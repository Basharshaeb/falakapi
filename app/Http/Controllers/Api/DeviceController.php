<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\DeviceRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $devices = Device::paginate();

        return DeviceResource::collection($devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request): Device
    {
        return Device::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device): Device
    {
        return $device;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceRequest $request, Device $device): Device
    {
        $device->update($request->validated());

        return $device;
    }

    public function destroy(Device $device): Response
    {
        $device->delete();

        return response()->noContent();
    }
}
