<?php

use App\Http\Controllers\Api\BookingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| Booking API Routes (Firebase Auth)
|--------------------------------------------------------------------------
|
| These routes are protected by Firebase ID token authentication.
| Pass token via Authorization: Bearer <firebase_id_token>
|
*/
Route::middleware(['firebase.api.auth'])->prefix('bookings')->group(function () {
    Route::get('/', [BookingApiController::class, 'index']);
    Route::get('/{id}', [BookingApiController::class, 'show']);
    Route::put('/{id}/cancel', [BookingApiController::class, 'cancel']);
    Route::put('/{id}/reschedule', [BookingApiController::class, 'reschedule']);
});
