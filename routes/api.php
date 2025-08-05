<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('signup' ,'Api\UserController@signUp');
Route::post('login' ,'Api\UserController@logIn');
Route::get('unauthorized','Api\UserController@unauthorized')->name('login');
Route::post('forget-password','Api\UserController@forgetPassword');

Route::middleware('auth:api')->group(function(){
    Route::get('user-profile','Api\UserController@getUserProfile');
    Route::post('update-profile','Api\UserController@updateProfile');
    Route::post('change-password','Api\UserController@changePassword');
    Route::get('log-out','Api\UserController@logOut');

    Route::get('get-categories','Api\VideoController@getCategories');

    Route::post('favourite-video','Api\VideoController@favouriteVideos');
    Route::get('get-videos/{id?}','Api\VideoController@getVideos');
    Route::get('get-more-videos','Api\VideoController@getMoreVideos');
    Route::get('get-favourite-videos','Api\VideoController@getFavouriteVideos');
    Route::post('search-video','Api\VideoController@searchVideo');
    Route::get('all-latest-videos','Api\VideoController@allLatestVideos');
    Route::get('most-like-videos','Api\VideoController@mostLikeVideos');
    Route::get('banner-videos','Api\VideoController@bannerVideos');

    Route::get('promotion-video','Api\VideoController@promotionVideo');

});
