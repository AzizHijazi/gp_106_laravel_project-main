<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\City;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ComponentTypeController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\DeskTypeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InternetAccountController;
use App\Http\Controllers\ItemServiceController;
use App\Http\Controllers\ItemComponentController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\MeetingRoomOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RentServicesController;
use App\Http\Controllers\RentTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingTimeController;
use App\Http\Controllers\WorkSpaceCategoryController;
use App\Models\Rent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('cms')->middleware('guest:admin,hub')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.show-login');
    Route::post('login', [AuthController::class, 'login'])->name('cms.login');
    Route::get('/forgot-password',[AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password',[AuthController::class, 'sendResetEmail'])->name('password.email');
    Route::get('/reset-password/{token}',[AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password',[AuthController::class, 'resetPassword'])->name('password.update');
});

Route::prefix('cms/admin')->middleware('auth:admin,hub')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('orders', OrderController::class);
    Route::get('create/order_items', [OrderItemController::class, 'create'])->name('order_items.create');
    Route::post('order_items/store', [OrderItemController::class, 'store'])->name('order_items.store');
    Route::put('order_items/{id}/update', [OrderItemController::class, 'update'])->name('order_items.update');
    Route::get('order_items/{type_name}/{id}/edit', [OrderItemController::class, 'edit'])->name('order_items.edit');
    Route::get('{type_name}/order_items', [OrderItemController::class, 'index'])->name('order_items.index');
    Route::get('{type_name}/{id}/order_items', [OrderItemController::class, 'show'])->name('order_items.show');
    Route::delete('{id}/order_items', [OrderItemController::class, 'destroy'])->name('order_items.destroy');

    Route::get('create/item_components', [ItemComponentController::class, 'create'])->name('item_components.create');
    Route::post('item_components/store', [ItemComponentController::class, 'store'])->name('item_components.store');
    Route::put('item_components/{id}/update', [ItemComponentController::class, 'update'])->name('item_components.update');
    Route::get('item_components/{id}/edit', [ItemComponentController::class, 'edit'])->name('item_components.edit');
    Route::get('{type_name}/item_components', [ItemComponentController::class, 'index'])->name('item_components.index');
    Route::get('{type_name}/{id}/item_components', [ItemComponentController::class, 'show'])->name('item_components.show');
    Route::delete('{id}/item_components', [ItemComponentController::class, 'destroy'])->name('item_components.destroy');

    Route::get('create/rent', [RentController::class, 'create'])->name('rent.create');
    Route::post('rent/storeConfrim', [RentController::class, 'storeConfirm'])->name('rent.storeConfirm');
    Route::post('rent/storeCanceled', [RentController::class, 'storeCanceled'])->name('rent.storeCanceled');
    Route::post('rent/store', [RentController::class, 'store'])->name('rent.store');
    Route::put('rent/{id}/update', [RentController::class, 'update'])->name('rent.update');
    Route::get('rent/{type_name}/{id}/edit', [RentController::class, 'edit'])->name('rent.edit');
    Route::get('{type_name}/rent', [RentController::class, 'index'])->name('rent.index');
    Route::get('{type_name}/{id}/rent', [RentController::class, 'show'])->name('rent.show');
    Route::delete('{id}/rent', [RentController::class, 'destroy'])->name('rent.destroy');
});

Route::prefix('cms/admin/')->middleware(['auth:admin,hub','verified'])->group(function () {
    Route::resource('desks', DeskController::class);
    Route::resource('hubs', HubController::class);
    Route::resource('cities', CityController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('desk_types', DeskTypeController::class);
    Route::resource('working_times', WorkingTimeController::class);
    Route::resource('item_services', ItemServiceController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('component_types', ComponentTypeController::class);
    Route::resource('components', ComponentController::class);
    Route::resource('meeting_rooms', MeetingRoomController::class);
    Route::resource('meetings', MeetingController::class);
    Route::resource('rent_types', RentTypeController::class);
    Route::resource('meeting_room_orders', MeetingRoomOrderController::class);
    Route::resource('internet_accounts', InternetAccountController::class);
    Route::resource('admins', AdminController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
    Route::resource('workspace', WorkSpaceCategoryController::class);
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('cms.edit-password');
    Route::put('update-password', [AuthController::class, 'updatePassword'])->name('cms.update-password');
    Route::resource('gallery', GalleryController::class);
    Route::resource('rent_services', RentServicesController::class);
    Route::resource('image', ImageController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('contact-request', ContactRequestController::class);
    Route::resource('user', UserController::class);

    //Route::resource('{type_name}/orders', OrderController::class);
});

