<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\DeviceRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = User::with('children')->find(Auth::user()->id);

if ($user) {
  $childIds = $user->children->pluck('id');  // Extract child IDs

  $devices = Device::whereIn('child_id', $childIds)
                   ->orderBy('created_at', 'desc')
                   ->paginate();

  return DeviceResource::collection($devices);
} else {
  return response()->json(['error' => 'User not found'], 404);
}

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request): Device
    {
        return Device::create($request->validated(),);
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

    // public function
}
