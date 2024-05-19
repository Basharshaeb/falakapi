<?php

namespace App\Http\Controllers\Api;

use App\Models\PermissionToFollow;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionToFollowRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionToFollowResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionToFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissionToFollows = PermissionToFollow::paginate();

        return PermissionToFollowResource::collection($permissionToFollows);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionToFollowRequest $request): PermissionToFollow
    {
        $toPerson=User::where('email',$request->to_person)->first();
        if($toPerson){

        }
        return PermissionToFollow::create(array_merge($request->validated(),[
            'to_person_id'=>$toPerson->id,
            'parent_id'=>Auth::user()->id,
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(PermissionToFollow $permissionToFollow): PermissionToFollow
    {
        return $permissionToFollow;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionToFollowRequest $request, PermissionToFollow $permissionToFollow): PermissionToFollow
    {
        $permissionToFollow->update($request->validated());

        return $permissionToFollow;
    }


    public function destroy($id): Response
    {
        // dd($id);
        // $permissionToFollow->delete();
return response()->json($id);
        return response()->noContent();
    }
    public function delete(Request $request, $id)
    {
        // dd($id);
        // $permissionToFollow->delete();
       $item= PermissionToFollow::where('child_id','=',$id)->where('to_person_id','=',Auth::user()->id);
       $item->delete();
return response()->json($item);
        // return response()->noContent();
    }
}
