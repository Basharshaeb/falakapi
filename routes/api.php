<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceModelTypeController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\FindLostChildController;
use App\Http\Controllers\Api\FollowChildController;
use App\Http\Controllers\Api\LostNotificationResponseController;
use App\Http\Controllers\Api\LostNotificationRequestController;
use App\Http\Controllers\Api\TrackingChildMasterController;
use App\Http\Controllers\Api\TrackingChildMasterDetailController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LocationHistoryController;
use App\Http\Controllers\Api\PermissionToFollowController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('device-model-types', DeviceModelTypeController::class);
Route::apiResource('devices', DeviceController::class)->middleware('auth:sanctum');;
Route::apiResource('find-lost-children', FindLostChildController::class);
Route::apiResource('follow-children', FollowChildController::class);
Route::apiResource('lost-notification-responses', LostNotificationResponseController::class);
Route::apiResource('lost-notification-requests', LostNotificationRequestController::class)->middleware('auth:sanctum');;
Route::get('nearby-requests',[ LostNotificationRequestController::class,'getByLocation'])->middleware('auth:sanctum');;
Route::apiResource('users', UserController::class);
Route::post('update-allow-track', [UserController::class,'updateAllowToTrack'])->middleware('auth:sanctum');

Route::apiResource('location-histories', LocationHistoryController::class)->middleware('auth:sanctum');;
Route::post('link-child', [UserController::class,'linkChild'])->middleware('auth:sanctum');
Route::post('create-child-by-parent', [AuthController::class,'createChildByParent'])->middleware('auth:sanctum');
Route::post('location-history', [LocationHistoryController::class,'getHistoryById'])->middleware('auth:sanctum');
Route::get('children', [UserController::class,'children'])->middleware('auth:sanctum');
Route::post('unlink-child', [UserController::class,'unlinkChild'])->middleware('auth:sanctum');
Route::post('update-tracking-method', [UserController::class,'updateTrackingMethod'])->middleware('auth:sanctum');
Route::apiResource('tracking-child-masters', TrackingChildMasterController::class);

Route::apiResource('tracking-child-master-details', TrackingChildMasterDetailController::class);
Route::post('login',[\App\Http\Controllers\api\AuthController::class,'login']);
Route::post('register',[\App\Http\Controllers\api\AuthController::class,'register']);
Route::post('register-child',[\App\Http\Controllers\api\AuthController::class,'registerChild']);
Route::apiResource('permission-to-follows', PermissionToFollowController::class)->middleware('auth:sanctum');
