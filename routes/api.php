<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIEmployeeController;
use App\Http\Controllers\API\ApiController;
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



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("v1/getemployee", [APIEmployeeController::class, "getEmployees"]);

Route::post('/signup' ,[ApiController::class, 'signup']);
Route::post('/signin' ,[ApiController::class, 'signin']);
Route::get('/getProfile',[ApiController::class, 'get_profile']);
