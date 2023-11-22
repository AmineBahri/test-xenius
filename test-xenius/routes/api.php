<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::post('/create-cv',[UserController::class,'createCV']);
      Route::get('/send-candidature/{id}',[UserController::class,'sendCandidature']);
    });
});

Route::get('/get-all-offers',[AdminController::class,'getAllOffers']);
Route::get('/get-offer/{id}',[AdminController::class,'getOffer']);
Route::post('/create-offer',[AdminController::class,'createOffer']);
Route::put('/update-offer/{id}',[AdminController::class,'updateOffer']);
Route::delete('/delete-offer/{id}',[AdminController::class,'deleteOffer']);
Route::get('/download-cv/{id}',[AdminController::class,'downloadCV']);

