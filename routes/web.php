<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('login','AdminController@loginView')->name('admin-log-in');
Route::post('login','AdminController@logIn')->name('log-in');
Route::get('logout','AdminController@logOut')->name('log-out');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/','AdminController@DashboardView')->name('dashboard');

    //category routes
    Route::get('view-categories','CategoryController@categoriesView')->name('view-categories');
    Route::get('add-category','CategoryController@addCategoryView')->name('add-category');
    Route::post('add-category','CategoryController@addCategory')->name('new-category');
    Route::get('delete-category/{id}','CategoryController@deleteCategory')->name('delete-category');
    Route::post('edit-category','CategoryController@editCategory')->name('edit-category');

    //users routes
    Route::get('view-users','UserController@viewUsers')->name('view-users');
    Route::get('delete-user/{id}','UserController@deleteUser')->name('delete-user');
    Route::post('edit-user','UserController@editUser')->name('edit-user');

    //videos routes
    Route::get('view-videos','VideoController@viewVideos')->name('view-videos');
    Route::get('add-video','VideoController@addVideoView')->name('add-video');
    Route::post('add-video','VideoController@addVideo')->name('new-video');
    Route::get('delete-video/{id}','VideoController@deleteVideo')->name('delete-video');
    Route::post('edit-video','VideoController@editVideo')->name('edit-video');

    //promotion routes
    Route::post('add-promotion-video','PromotionController@addPromotionVideo')->name('add-promotion-video');
    Route::get('video-promotion','PromotionController@promotionView')->name('video-promotion');
    Route::post('update-promotion','PromotionController@updatePromotion')->name('update-promotion');

    Route::post('upload','PromotionController@upload')->name('upload');
    Route::post('/file-upload', 'PromotionController@upload')->name('uploader');
    Route::get('edit-video-view/{id}','PromotionController@editVideoView')->name('edit-video-view');
    Route::get('edit-promotion-video-view/{id}','PromotionController@editPromotionVideoView')->name('edit-promotion-video-view');

    //Advertisement routes
    Route::get('view-advertisements', 'AdvertisementController@viewAdvertisements')->name('view-advertisements');
    Route::post('add-advertisement', 'AdvertisementController@addAdvertisement')->name('add-advertisement');
    Route::get('delete-advertisement/{id}', 'AdvertisementController@deleteAdvertisement')->name('delete-advertisement');
    Route::post('edit-advertisement', 'AdvertisementController@editAdvertisement')->name('edit-advertisement');
});

