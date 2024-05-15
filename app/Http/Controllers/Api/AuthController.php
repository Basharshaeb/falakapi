<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\Email;
use App\Models\Student;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Illuminate\Support\Str;

use Ramsey\Uuid\Type\Integer;

class AuthController extends Controller
{
    //
    public function profile(Request $request)
    {


        $user =Auth::user();

        return response()->json(['message' => 'Email verified successfully',
            'success' => true,'user'=>$user]);
    }
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->verification_code !== $request->code) {
            return response()->json(['message' => 'Invalid email or verification code', 'success' => true], 401);
        }

        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'Email verified successfully',
            'success' => true,]);
    }
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'user_type' => 'required|string',
        ]);

//        return  response()->json($request);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(),
                'success' => false,
            ]);
        }
// return response()->json($request);

        $user= User::create([
            'full_name' => $request->full_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'fcm_token' => $request->fcm_token,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'username_type' => $request->username_type,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude  ,

        ]);
        $randomString = $this->generateRandomSixDigitNumber();
        $user->verification_code=$randomString;
        $user->save();
        // Mail::to($user->email)->send(new Email($randomString));
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
          [
          'access_token' => $token,
            'message' => 'success Create Account',
            'success' => true,
            'user' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'type' => $user->type,
    ]]);
    }


    public function registerChild(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'user_type' => 'required|string',
        ]);

//        return  response()->json($request);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(),
                'success' => false,
            ]);
        }



        $user= User::create([
            'full_name' => $request->full_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'fcm_token' => $request->fcm_token,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'username_type' => $request->username_type,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude  ,
            'main_image_path' => '' ,
            'qe_code_info' => Str::uuid()->toString() ,
            'qr_code_link' => Str::uuid()->toString() ,
            'kinshipT' => $request->kinshipT ,
            'child_status' => 'active' ,
            // 'main_person_in_charge_id' => $request->kinshipT ,

        ]);
        if($request->has('image')){
            $file= $request->image;
            $hash = md5(time() . uniqid());
            $newFileName = $hash . '.' . $file->getClientOriginalExtension();
            $user->addMedia($file)->usingFileName($newFileName)->toMediaCollection('profile');
            $user->main_image_path= $file;
        }
        $randomString = $this->generateRandomSixDigitNumber();
        $user->verification_code=$randomString;
        $user->save();
        // Mail::to($user->email)->send(new Email($randomString));
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
          [
          'access_token' => $token,
            'message' => 'success Create Account',
            'success' => true,
            'user' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'type' => $user->type,
    ]]);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
//            'mac_address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(),
                'success' => false,
            ]);
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                ['message' => 'Invalid credentials',

                    'success' => false,], 400);
        }
//        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
//            $token = $user->createToken($user->email)->plainTextToken;
            $randomString = $this->generateRandomSixDigitNumber();
            $user->verification_code=$randomString;
            $user->save();
            $subject="رمز التحقق الخاص بك هو ";
            // Mail::to($user->email)->send(new Email($randomString,$subject,$subject));
//            return response()->json([
//                'code' => 200,
//                'token' => $token,
//                'user' => $user,
//            ], $this->successStatus);
//        } else {
//            return response()->json(['code' => 401, 'message' => 'email or password invalid'], 401);
//        }
//        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'message' => '',
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
            ]
        ]);
    }
    function generateRandomSixDigitNumber(): string
    {
        $number = rand(100000, 999999);
        return str_pad($number, 6, '0', STR_PAD_LEFT);
    }

}
