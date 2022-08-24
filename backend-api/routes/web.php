<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/login', [UserController::class, 'showLoginPage'])->name('login-web');
Route::post('/auth/login/proses', [UserController::class, 'prosesLogin']);
Route::get('/auth/logout', [UserController::class, 'prosesLogout']);

// Route::group(['middleware' => 'auth'], function () {
//     Route::group(['middleware' => []], function() {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // donasi
        Route::get('/dashboard/donasi', [DonasiController::class, 'index']);
        Route::post('/dashboard/donasi/approve/{id}', [DonasiController::class, 'approve']);
        Route::post('/dashboard/donasi/reject/{id}', [DonasiController::class, 'reject']);

        // campaign
        Route::get('/dashboard/campaign', [CampaignController::class, 'indexAdmin']);
        Route::post('/dashboard/campaign/add', [CampaignController::class, 'store']);
        Route::get('/dashboard/campaign/{id}', [CampaignController::class, 'detailAdmin']);
        Route::post('/dashboard/campaign/{id}/remove', [CampaignController::class, 'remove']);
        Route::get('/dashboard/campaign/{id}/edit', [CampaignController::class, 'edit']);
        Route::post('/dashboard/campaign/{id}/edit/addimage', [CampaignController::class, 'tambahGambar']);
        Route::post('/dashboard/campaign/{id}/edit/removeimage', [CampaignController::class, 'hapusGambar']);
        Route::post('/dashboard/campaign/{id}/update', [CampaignController::class, 'update']);
        Route::get('/dashboard/campaign/{id}/edit/gambar/{id_gambar}', [CampaignController::class, 'editGambar']);

        // banner
        Route::get('/dashboard/banner', [BannerController::class, 'index']);
        Route::post('/dashboard/banner/add', [BannerController::class, 'store']);
        Route::post('/dashboard/banner/{id}/remove', [BannerController::class, 'remove']);
        Route::get('/dashboard/banner/edit/{id}', [BannerController::class, 'edit']);
        Route::post('/dashboard/banner/update/{id}', [BannerController::class, 'update']);

        // user
        Route::get('/dashboard/user', [UserController::class, 'index']);
    // });
// });
