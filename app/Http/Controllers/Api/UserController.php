<?php

namespace App\Http\Controllers\Api;

use App\Models\FollowChild;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function children(Request $request)
     {

        $user=Auth::user();
        // $use=User::find($user)->with('children')->get();
        $child=$user->children;

         return response()->json(['message'=>'','success'=>true,'data'=>$child]);
     }
     public function updateAllowToTrack(Request $request){

        $childId= $request->child_id;
        $userId=Auth::user()->id;
        FollowChild::where('child_id',$childId)->where('user_id',$userId)->update(
           [ 'allow_to_track'=>$request->value,]
        );
        return response()->json(['message'=> '','success'=>true,    'data'=>$childId]);
     }

     public function unlinkChild(Request $request)
     {

        $child=User::where('id','=',$request->child_id)->get()->first();
        $child->kinshipT=null;
        $child->boundry=null;
        $child->AdditionalInformation=null;
        $child->save();
        // $followChild=new FollowChild();
        // $followChild->user_id=Auth::user()->id;
        // $followChild->child_id=$child->id;
        // if($type=='barcode'){
        //     $followChild->has_card='true';
        // }
        // if($type=='device'){
        //     $followChild->track_by_device='true';
        // }
        // if($type=='app'){
        //     $followChild->track_by_app='true';
        // }
        // $followChild->save();
        //  $users = User::paginate();

         return response()->json(['message'=>'success link','success'=>true,'data'=>$child]);
     }

     public function linkChild(Request $request)
     {
        $type=$request->link_type;
if(!empty($request->child_id)){
    $child=User::where('id','=',$request->child_id)->get()->first();

}if(!empty($request->barcode)){
    $child=User::where('qe_code_info','=',$request->barcode)->get()->first();
}
        $child->kinshipT=$request->kinshipT;
        $child->boundry=$request->boundry;
        $child->main_person_in_charge_id=Auth::user()->id;
        $child->AdditionalInformation=$request->addition;
        $child->save();
        $followChild=new FollowChild();
        $followChild->user_id=Auth::user()->id;
        $followChild->child_id=$child->id;
        if($type=='barcode'){
            $followChild->has_card='true';
        }
        if($type=='device'){
            $followChild->track_by_device='true';
        }
        if($type=='app'){
            $followChild->track_by_app='true';
        }
        $followChild->tracking_active_type=$type;
        $followChild->allow_to_track='true';
        $followChild->save();
        //  $users = User::paginate();

         return response()->json(['message'=>'success link','success'=>true,'data'=>$child]);
     }
     public function updateTrackingMethod(Request $request)
     {
        $type=$request->link_type;
        $child=User::where('id','=',$request->child_id)->get()->first();
        $child->kinshipT=$request->kinshipT;
        $child->boundry=$request->boundry;
        $child->AdditionalInformation=$request->addition;
        $child->save();
        $followChild= FollowChild::where('child_id','=',$request->child_id)->get()->first();
        // $followChild->user_id=Auth::user()->id;
        // $followChild->child_id=$child->id;
        if($type=='barcode'){
            $followChild->has_card='true';
        }
        if($type=='device'){
            $followChild->track_by_device='true';
        }
        if($type=='app'){
            $followChild->track_by_app='true';
        }
        $followChild->save();
        //  $users = User::paginate();

         return response()->json(['message'=>'success link','success'=>true,'data'=>$child]);
     }

    public function index(Request $request)
    {
        $users = User::paginate();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): User
    {
        return User::create($request->validated());
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user): User
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): User
    {
        $user->update($request->validated());

        return $user;
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
