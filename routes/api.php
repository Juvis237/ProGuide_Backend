<?php

use App\Http\Controllers\API\EditProfileController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\PortfolioController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SendSMSController;
use App\Http\Controllers\API\UserVerificationController;
use App\Http\Controllers\CampayController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ReferalController;
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

//verify-email


Route::group(['namespace' => 'API'], function () {
    // login user
    Route::post('login', [AuthController::class, "login"]);
    Route::post('agent/login', [AuthController::class, "agentLogin"]);
    // register user

    Route::post('register', [AuthController::class, "register"]);
    Route::post('sms', [SendSMSController::class, "send"]);
    Route::get('cities', [LocationController::class, "getCities"]);
    Route::get('regions', [LocationController::class, "getRegions"]);
    Route::post('search', [RequestController::class, "search"]);

    Route::middleware('auth:api')->group(function () {
        // update user profile data
        Route::post('profile_update', [ProfileController::class, 'update']);
        Route::get('profile', [ProfileController::class, 'show']);
        Route::post('save_skills', [ProfileController::class, 'saveSkills']);
        Route::post('user/change_password', [ProfileController::class,'changePassword']);
        Route::get('user/profile/delete', [ProfileController::class, 'delete']);
        Route::post('send_verification_code', [UserVerificationController::class, "sendVerificationCode"]);
        Route::post('resend_verification_code', [UserVerificationController::class, "resendVerificationCode"]);
        Route::post('verify_code', [UserVerificationController::class, "verifyCode"]);
        Route::post('rate_request', [RequestController::class, "rateRequest"]);
        Route::get('schools', [RequestController::class, "getSchools"]);
        Route::get('modes', [RequestController::class, "getModes"]);
        Route::get('delivrables', [RequestController::class, "getDelivrables"]);
    });


    Route::group(['middleware' => ['auth:api']], function () {


        Route::group(['prefix' => 'requests'], function () {
            Route::get('', [RequestController::class, 'getRequests']);
            Route::post('add_request', [RequestController::class, 'addRequest']);
            Route::post('update_request/{id}', [RequestController::class, 'updateRequest']);
            Route::post('delete_request/{id}', [RequestController::class, 'deleteRequest']);
            Route::post('send_request/{id}', [RequestController::class, 'sendRequest']);
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [ProfileController::class, 'show']);
            Route::get('change_password', [EditProfileController::class, 'changePassword']);
            Route::post('save_profile_image', [EditProfileController::class, 'saveProfileImage']);
        });
        
        // Campay routes requiring authentication
        Route::post('pay', [CampayController::class, 'collect']);
        Route::get('transaction', [CampayController::class, 'getTransactionStatus']);

        //wallet and transactions
        Route::get('balance', [WalletController::class, 'balance']);
        Route::get('transactions', [WalletController::class, 'transactions']);

        // referals
        Route::get('referrals', [ReferalController::class, 'get_referrals']);
    });
});
