<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SettlementController;

Route::group(['middleware'=>['guest:sanctum']],function(){
    Route::post('sign-up'                                 ,[AuthController::class,       'register']);
    Route::patch('activate'                               ,[AuthController::class,       'activate']);
    Route::get('resend-code'                              ,[AuthController::class,       'resendCode']);
    Route::post('sign-in'                                 ,[AuthController::class,       'login']);
    Route::post('forget-password-send-code'               ,[AuthController::class,       'forgetPasswordSendCode']);
    Route::post('reset-password'                          ,[AuthController::class,       'resetPassword']);
    Route::post('check-code' ,[AuthController::class,       'checkCode']) ;
});

Route::group(['middleware'=>['OptionalSanctumMiddleware']],function(){
    Route::get('about',                                   [SettingController::class,     'about']);
    Route::get('terms',                                   [SettingController::class,     'terms']);
    Route::get('privacy',                                 [SettingController::class,     'privacy']);
    Route::get('intros',                                  [SettingController::class,     'intros']);
    Route::get('fqss',                                    [SettingController::class,     'fqss']);
    Route::get('socials',                                 [SettingController::class,     'socials']);
    Route::get('images',                                  [SettingController::class,     'images']);
    Route::get('categories/{id?}',                        [SettingController::class,     'categories']);
    Route::get('countries',                               [SettingController::class,     'countries']);
    Route::get('countries-with-cities',                   [SettingController::class,     'countriesWithCities']);
    Route::get('cities',                                  [SettingController::class,     'cities']);
    Route::get('country/{country_id}/cities',             [SettingController::class,     'CountryCities']);
    Route::post('check-coupon',                           [SettingController::class,     'checkCoupon']);
    Route::get('is-production',                           [SettingController::class,     'isProduction']);


    Route::get('home'    ,                                            [HomeController::class,'index']);
    Route::get('search-product'    ,                                 [HomeController::class,'search']);
    Route::get('all-best-selling'    ,                                 [ProductController::class,'allBestSelling']);
    Route::get('all-best-offer'    ,                                 [ProductController::class,'allBestOffer']);
    Route::get('all-new-collection'    ,                                 [ProductController::class,'allNewCollection']);
    Route::get('product-with-category/{id}'    ,                                 [ProductController::class,'productWithCategory']);
    Route::get('list-categories'    ,                                 [ProductController::class,'listCategory']);
    Route::get('product/{id}' , [ProductController::class,'productWithId']);
    Route::get('rate/{id}' , [ProductController::class,'rates']);


});


Route::group(['middleware'=>['auth:sanctum','is-active']],function () {
    Route::delete('sign-out'                              ,[AuthController::class,       'logout']);
    Route::get('profile'                                  ,[AuthController::class,       'getProfile']);
    Route::put('update-profile'                           ,[AuthController::class,       'updateProfile']);
    Route::patch('update-passward'                        ,[AuthController::class,       'updatePassword']);
    Route::patch('change-lang'                            ,[AuthController::class,       'changeLang']);
    Route::patch('switch-notify'                          ,[AuthController::class,       'switchNotificationStatus']);
    Route::post('change-phone-send-code'                  ,[AuthController::class,       'changePhoneSendCode']);
    Route::post('change-phone-check-code'                 ,[AuthController::class,       'changePhoneCheckCode']);
    Route::post('change-email-send-code'                  ,[AuthController::class,       'changeEmailSendCode']);
    Route::post('change-email-check-code'                 ,[AuthController::class,       'changeEmailCheckCode']);
    Route::get('notifications'                            ,[AuthController::class,       'getNotifications']);
    Route::get('count-notifications'                      ,[AuthController::class,       'countUnreadNotifications']);
    Route::delete('delete-notification/{notification_id}' ,[AuthController::class,       'deleteNotification']);
    Route::delete('delete-notifications'                  ,[AuthController::class,       'deleteNotifications']);
    Route::post('new-complaint'                           ,[AuthController::class,       'StoreComplaint']);
    Route::post('settlement-request'                      ,[SettlementController::class, 'settlementRequest']);

    // Route Home ///


    /// end Route
    Route::get('create-room',                             [ChatController::class,        'createRoom']);
    Route::post('create-private-room',                    [ChatController::class,        'createPrivateRoom']);
    Route::get('room-members/{room}',                     [ChatController::class,        'getRoomMembers']);
    Route::get('join-room/{room}',                        [ChatController::class,        'joinRoom']);
    Route::get('leave-room/{room}',                       [ChatController::class,        'leaveRoom']);
    Route::get('get-room-messages/{room}',                [ChatController::class,        'getRoomMessages']);
    Route::get('get-room-unseen-messages/{room}',         [ChatController::class,        'getRoomUnseenMessages']);
    Route::get('get-rooms',                               [ChatController::class,        'getMyRooms']);
    Route::delete('delete-message-copy/{message}',        [ChatController::class,        'deleteMessageCopy']);
    Route::post('send-message/{room}',                    [ChatController::class,        'sendMessage']);
    Route::post('upload-room-file/{room}',                [ChatController::class,        'uploadRoomFile']);
});
