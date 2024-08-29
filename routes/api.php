<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatisticController;


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

// عرض جميع السائقين
Route::get('drivers', [DriverController::class, 'index']);
// إنشاء سائق جديد
Route::post('drivers', [DriverController::class, 'store']);
// عرض تفاصيل سائق محدد
Route::get('drivers/{driver}', [DriverController::class, 'show']);
// تحديث بيانات سائق محدد
Route::put('drivers/{driver}', [DriverController::class, 'update']);
// حذف سائق محدد
Route::delete('drivers/{driver}', [DriverController::class, 'destroy']);

// Route::post('register', [DriverController::class, 'store']);
Route::post('login', [DriverController::class, 'login']);
Route::post('logout', [DriverController::class, 'logout'])->middleware('auth:api');

//////////////////////////////////////////////////////////////////////////////////////////////////

// عرض جميع الأثاث
Route::get('furnitures', [FurnitureController::class, 'index']);
// إنشاء أثاث جديد
Route::post('furnitures', [FurnitureController::class, 'store']);
// عرض تفاصيل أثاث محدد
Route::get('furnitures/{furniture}', [FurnitureController::class, 'show']);
// تحديث بيانات أثاث محدد
Route::put('furnitures/{furniture}', [FurnitureController::class, 'update']);
// حذف أثاث محدد
Route::delete('furnitures/{furniture}', [FurnitureController::class, 'destroy']);

//////////////////////////////////////////////////////////////////////////////////////////////////

// عرض جميع الطلبات
Route::get('orders', [OrderController::class, 'index']);
// إنشاء طلب جديد
Route::post('orders', [OrderController::class, 'store']);
// عرض تفاصيل طلب محدد
Route::get('orders/{order}', [OrderController::class, 'show']);
// تحديث بيانات طلب محدد
Route::put('orders/{order}', [OrderController::class, 'update']);
// حذف طلب محدد
Route::delete('orders/{order}', [OrderController::class, 'destroy']);

//////////////////////////////////////////////////////////////////////////////////////////////////

// عرض جميع المستخدمين
Route::get('users', [UserController::class, 'index']);
// إنشاء مستخدم جديد
Route::post('users/create', [UserController::class, 'store']);
// عرض تفاصيل مستخدم محدد
Route::get('users/{user}', [UserController::class, 'show']);
// تحديث بيانات مستخدم محدد
Route::put('users/{user}', [UserController::class, 'update']);
// حذف مستخدم محدد
Route::delete('users/{user}', [UserController::class, 'destroy']);

//////////////////////////////////////////////////////////////////////////////////////////////////

// عرض جميع المركبات
Route::get('vehicles', [VehicleController::class, 'index']);
// إنشاء مركبة جديدة
Route::post('vehicles', [VehicleController::class, 'store']);
// عرض تفاصيل مركبة محددة
Route::get('vehicles/{vehicle}', [VehicleController::class, 'show']);
// تحديث بيانات مركبة محددة
Route::put('vehicles/{vehicle}', [VehicleController::class, 'update']);
// حذف مركبة محددة
Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy']);



Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');






// عرض جميع الإحصائيات
Route::get('statistics', [StatisticController::class, 'index']);
// إنشاء إحصائية جديدة
Route::post('statistics', [StatisticController::class, 'store']);
// عرض تفاصيل إحصائية محددة
Route::get('statistics/{statistic}', [StatisticController::class, 'show']);
// تحديث بيانات إحصائية محددة
Route::put('statistics/{statistic}', [StatisticController::class, 'update']);
// حذف إحصائية محددة
Route::delete('statistics/{statistic}', [StatisticController::class, 'destroy']);



Route::patch('orders/{order_id}/complete', [OrderController::class, 'completeOrder']);




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});