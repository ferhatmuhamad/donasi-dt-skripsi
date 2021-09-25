<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonasiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

// campaign
Route::get('campaigns', [CampaignController::class, 'index']);
Route::get('campaign/{id}', [CampaignController::class, 'detail']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('profile', [AuthController::class, 'userProfile']);
    Route::get('testjwt', function () {
        return response(['oke' => 'oke bisa']);
    });

    // donasi
    Route::post('donasi/{id}', [DonasiController::class, 'prosesDonasi']);
});
