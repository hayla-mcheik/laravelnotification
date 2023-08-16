<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contactus',[ApiController::class,'contact']);
Route::post('/startwork',[ApiController::class,'startwork']);
Route::post('/subscribe',[ApiController::class,'subscribe']);


Route::get('/home',[ApiController::class,'homeScreen']);
Route::get('/agency',[ApiController::class,'agencyScreen']);
Route::get('/services',[ApiController::class,'serviceScreen']);
Route::get('/services/{id}',[ApiController::class,'getservicesDetails']);
Route::get('/servicescategories/{id}',[ApiController::class,'Categories']);
Route::get('/blog',[ApiController::class,'blogScreen']);
Route::get('/blog/{id}',[ApiController::class,'getblogDetails']);
Route::get('/categories',[ApiController::class,'AllCategories']);
Route::get('/categories/{id}',[ApiController::class,'Categories']);
Route::get('/project',[ApiController::class,'projectScreen']);
Route::get('/project/{id}',[ApiController::class,'getprojectDetails']);
Route::get('/casestudies',[ApiController::class,'casestudiesScreen']);


