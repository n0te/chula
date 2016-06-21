<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    /**
     * Show Homepage
     */
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');


    /**
     * UserController
     */
    Route::get('/profile', 'UserController@profile');
    Route::get('/module', 'UserController@module');
    Route::get('/getmodules', 'UserController@getModules');
    Route::get('/managemember', 'AdminController@managemember');
    Route::get('/changepassword', 'UserController@password');
    Route::get('/getdocuments', 'UserController@getDocuments');
    Route::post('/requestmodule/{module_id}', 'UserController@requestModule');
    Route::post('/profile', 'UserController@updateProfile');
    Route::post('/changepassword', 'UserController@changepassword');
    Route::post('/deleteDoc/{id}', 'UserController@deleteDoc');

    Route::post('/updaterole', 'ProfileController@updaterole');
    Route::post('/reject/{module}/{id}', 'AdminController@reject');
    Route::post('/approve/{module}/{id}', 'AdminController@approve');
    Route::get('/reviewprofile/{userid}', 'AdminController@reviewprofile');
    Route::get('/reviewmembers', 'AdminController@reviewMembers');
    Route::get('/getreviewmembers', 'AdminController@getReviewMembers');
    Route::get('/getdocuments/{userid}', 'AdminController@getDocuments');
    Route::get('/getreviewmodules/{userid}', 'AdminController@getReviewModules');



    Route::get('/requestform', 'RequestFormController@index');
    Route::get('/reviewform', 'RequestFormController@reviewform');
    Route::get('/approveformbyadmin/{id}', 'RequestFormController@approveformbyadmin');
    Route::post('/SaveForm', 'RequestFormController@SaveForm');
    Route::post('/SaveReject', 'RequestFormController@SaveReject');
    Route::get('/allformrequest', 'RequestFormController@allformrequest');
    Route::get('/deleteformrequest/{id}', 'RequestFormController@deleteformrequest');
    Route::get('/deleteformrequestadmin/{id}', 'RequestFormController@deleteformrequestadmin');
    Route::get('/requestform/{id}', 'RequestFormController@editrequestform');
    Route::get('/getFormDataByID/{id}', 'RequestFormController@getFormDataByID');
    Route::get('/approveformreq/{id}', 'RequestFormController@approveformreq');
    Route::get('/contactus', 'RequestFormController@contactus');
    Route::get('/createdocx/{id}', 'RequestFormController@CreateDocx');
    Route::get('/check', 'RequestFormController@check');
    Route::get('/check2', 'RequestFormController@check2');
});

