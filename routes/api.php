<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApprovalController;


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('verification-code/{email}', [AuthController::class, 'verifyCode']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/approval-request', [NotificationController::class,'requestnotification']);
Route::post('/submit-request', 'ApprovalController@submitRequest');
Route::put('/review-request/{requestId}', 'ApprovalController@reviewRequest');


Route::middleware('auth:sanctum')->get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json(['message' => 'CSRF cookie set']);
});
