<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\WorkingTimeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RentServicesController;
use App\Http\Controllers\WorkSpaceCategoryController;
use App\Models\OrderItem;
use App\Models\WorkSpaceCategory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthUserController::class, 'register']);
    Route::post('login', [AuthUserController::class, 'login']);
    Route::post('forgot-password', [AuthUserController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthUserController::class, 'resetPassword']);
});

Route::prefix('auth')->middleware('auth:user')->group(function () {
    Route::get('logout', [AuthUserController::class, 'logout']);

    Route::get('rent/myRent', [RentController::class, 'myRent']);

    Route::get('deskTypeForDesk',[DeskController::class, 'deskTypeForDesk']);
    Route::get('roomsBelongsToHub',[HubController::class, 'roomsBelongsToHub']);
    Route::get('deskBelongsToHub',[HubController::class, 'deskBelongsToHub']);
    Route::get('/city',[CityController::class,'index']);
    Route::get('/WorkingTime',[WorkingTimeController::class,'index']);
    Route::get('workingTimesForTheHub',[HubController::class, 'workingTimesForTheHub']);
    Route::apiResource('cities', CityController::class);
    Route::apiResource('orders', OrderController::class);
    Route::post('change-password', [ApiAuthController::class, 'changePassword']);
    Route::apiResource('room', RoomController::class);
    Route::apiResource('desk', DeskController::class);
    Route::apiResource('meetingRoomController', MeetingRoomController::class);

    Route::get('order/myOrders', [OrderItemController::class, 'myOrders']);
    Route::post('completeProfile', [AuthUserController::class, 'completeProfile']);
  
    Route::get('deskBelongsToHub/{id}', [HubController::class, 'deskBelongsToHub']);
    Route::get('all', [HubController::class, 'allIndex']);
    Route::get('workSpaceCategory', [WorkSpaceCategoryController::class, 'index']);
});

Route::get('roomsBelongsToHub', [HubController::class, 'roomsBelongsToHub']);
Route::get('deskTypeForDesk', [DeskController::class, 'deskTypeForDesk']);
Route::get('all', [HubController::class, 'allIndex']);
Route::get('allForHub/{id}', [HubController::class, 'allForHub']);
Route::get('deskBelongsToHub/{id}', [HubController::class, 'deskBelongsToHub']);
Route::get('workSpaceCategory', [WorkSpaceCategoryController::class, 'index']);

Route::get('city', [CityController::class, 'index']);
Route::get('workingTime', [WorkingTimeController::class, 'index']);
Route::get('workingTimesForTheHub', [HubController::class, 'workingTimesForTheHub']);
Route::apiResource('cities', CityController::class);
Route::apiResource('hubs', HubController::class);
Route::apiResource('rent_services', RentServicesController::class);
Route::apiResource('faq', FaqController::class);
Route::apiResource('contact-request', ContactRequestController::class);

