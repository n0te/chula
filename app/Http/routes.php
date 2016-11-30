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

    Route::get('/exporttoexcel', 'RequestFormController@exporttoexcel');
    Route::get('/requestform', 'RequestFormController@index');
    Route::get('/reviewform', 'RequestFormController@reviewform');
    Route::get('/approveformbyadmin/{id}', 'RequestFormController@approveformbyadmin');
    Route::post('/SaveForm', 'RequestFormController@SaveForm');
    Route::post('/SaveReject', 'RequestFormController@SaveReject');
    Route::post('/SaveMemo', 'RequestFormController@SaveMemo');
    Route::post('/SaveAnnouncementNumber', 'RequestFormController@SaveAnnouncementNumber');
    Route::get('/allformrequest', 'RequestFormController@allformrequest');
    Route::get('/deleteformrequest/{id}', 'RequestFormController@deleteformrequest');
    Route::get('/deleteformrequestadmin/{id}', 'RequestFormController@deleteformrequestadmin');
    Route::get('/requestform/{id}', 'RequestFormController@editrequestform');
    Route::get('/getFormDataByID/{id}', 'RequestFormController@getFormDataByID');
    Route::get('/contactus', 'RequestFormController@contactus');
    Route::get('/createdocx/{id}', 'RequestFormController@CreateDocx');
    Route::get('/receivepaper/{id}', 'RequestFormController@receivepaper');

    Route::get('/test', 'RequestFormController@test');

    Route::get('/mrc', 'MRCController@index');
    Route::get('/placemng', 'MRCController@placemng');
    Route::get('/getplace', 'MRCController@getPlace');
    Route::get('/getPlaceByID/{id}', 'MRCController@getPlaceByID');
    Route::get('/deletePlaceByID/{id}', 'MRCController@deletePlaceByID');
    Route::post('/SavePlace', 'MRCController@SavePlace');
    Route::post('/EditPlace', 'MRCController@EditPlace');


    Route::get('/groupmng', 'MRCController@groupmng');
    Route::get('/getgroup', 'MRCController@getGroup');
    Route::get('/getGroupByID/{id}', 'MRCController@getGroupByID');
    Route::get('/deleteGroupByID/{id}', 'MRCController@deleteGroupByID');
    Route::post('/SaveGroup', 'MRCController@SaveGroup');
    Route::post('/EditGroup', 'MRCController@EditGroup');

    Route::get('/cousemng', 'MRCController@cousemng');
    Route::get('/getcouse', 'MRCController@getCouse');
    Route::get('/getCouseByID/{id}', 'MRCController@getCouseByID');
    Route::get('/deleteCouseByID/{id}', 'MRCController@deleteCouseByID');
    Route::post('/SaveCouse', 'MRCController@SaveCouse');
    Route::post('/EditCouse', 'MRCController@EditCouse');

    Route::get('/equipmentmng', 'MRCController@equipmentmng');
    Route::get('/getequipmentfortbl', 'MRCController@getEquipment');
    Route::get('/getEquipmentByID/{id}', 'MRCController@getEquipmentByID');
    Route::get('/deleteEquipmentByID/{id}', 'MRCController@deleteEquipmentByID');
    Route::post('/SaveEquipment', 'MRCController@SaveEquipment');
    Route::post('/EditEquipment', 'MRCController@EditEquipment');


    Route::get('/mrcbookingmng', 'MRCController@mrcbookingmng');
    Route::get('/getEquipmentforbooking', 'MRCController@getEquipmentforbooking');
    Route::post('/BookEquipment', 'MRCController@BookEquipment');
    Route::get('/getBookingbyEquipmentid/{id}', 'MRCController@getBookingbyEquipmentid');
    Route::get('/getBookingbyEquipmentidWithUsername/{id}', 'MRCController@getBookingbyEquipmentidWithUsername');
    Route::get('/mymrcbooking', 'MRCController@mymrcbooking'); //getBookingByUserId
    Route::get('/getBookingByUserId', 'MRCController@getBookingByUserId');


    Route::get('/mrcbookingmngadmin', 'MRCController@mrcbookingmngadmin');
    Route::get('/deleteBookingByID/{id}', 'MRCController@deleteBookingByID');
    Route::post('/checkTimeAvailable', 'MRCController@checkTimeAvailable');
    Route::get('/testcomname', 'MRCController@testcomname');
    Route::get('/cfmBookingByID/{id}', 'MRCController@cfmBookingByID');
    Route::get('/deleteBookingByIDByUser/{id}', 'MRCController@deleteBookingByIDByUser');
    Route::get('/mrcbookingstat', 'MRCController@mrcbookingstat');
    Route::post('/getchart', 'MRCController@getchart');

    Route::post('/setAccess', 'MRCController@setAccess');
    Route::get('/banning', 'MRCController@banning');

    Route::get('/banningadmin', 'MRCController@banningadmin');
    Route::get('/getBanning', 'MRCController@getBanning');
    Route::post('/activeBanning', 'MRCController@activeBanning');
    Route::get('/mrcexporttoexcel/{d1}/{d2}', 'MRCController@mrcexporttoexcel');
    Route::get('/mrcannouncementadmin', 'MRCController@mrcannouncementadmin');

    Route::post('/saveannouncementmrc', 'MRCController@saveannouncementmrc');
    Route::get('/gethtmlannouncementmrc', 'MRCController@gethtmlannouncementmrc');
    Route::get('/mrcannouncement', 'MRCController@mrcannouncement');

    Route::post('/uploadpictureforannouncement', 'MRCController@uploadpictureforannouncement');

    Route::get('/teachermng', 'BiostatController@teachermng');
    Route::post('/SaveTeacher', 'BiostatController@SaveTeacher');
    Route::get('/getTeacher', 'BiostatController@getTeacher');
    Route::get('/deleteTeacherByID/{id}', 'BiostatController@deleteTeacherByID');
    Route::get('/getTeacherByID/{id}', 'BiostatController@getTeacherByID');
    Route::post('/EditTeacher', 'BiostatController@EditTeacher');
    Route::get('/bioannouncementadmin', 'BiostatController@bioannouncementadmin');
    Route::post('/saveannouncementbio', 'BiostatController@saveannouncementbio');
    Route::get('/gethtmlannouncementbio', 'BiostatController@gethtmlannouncementbio');
    Route::get('/bioannouncement', 'BiostatController@bioannouncement');
    Route::get('/biobooking', 'BiostatController@biobooking');
    Route::get('/getTeacherforbooking', 'BiostatController@getTeacherforbooking');
    Route::get('/getBookingbyTeacherid/{id}', 'BiostatController@getBookingbyTeacherid');
    Route::post('/biocheckTimeAvailable', 'BiostatController@biocheckTimeAvailable');
    Route::post('/BookTeacher', 'BiostatController@BookTeacher');
    Route::get('/getBioBookingByUserId', 'BiostatController@getBioBookingByUserId');
    Route::get('/mybiobooking', 'BiostatController@mybiobooking');
    Route::post('/setAccessBio', 'BiostatController@setAccessBio');
    Route::get('/getBookingbyTeacheridWithUsername/{id}', 'BiostatController@getBookingbyTeacheridWithUsername');
    Route::get('/deleteBioBookingByIDByUser/{id}', 'BiostatController@deleteBioBookingByIDByUser');
    Route::get('/cfmBioBookingByID/{id}', 'BiostatController@cfmBioBookingByID');
    Route::get('/biobookingmngadmin', 'BiostatController@biobookingmngadmin');
    Route::get('/deleteBioBookingByID/{id}', 'BiostatController@deleteBioBookingByID');
    Route::get('/getBioBanning', 'BiostatController@getBioBanning');
    Route::get('/biobanningadmin', 'BiostatController@biobanningadmin');
    Route::post('/activeBioBanning', 'BiostatController@activeBioBanning');
    Route::get('/biobookingreport', 'BiostatController@biobookingreport');
    Route::post('/getchartbio', 'BiostatController@getchartbio');
    Route::get('/bioexporttoexcel/{d1}/{d2}', 'BiostatController@bioexporttoexcel');

    Route::get('/aniroommng', 'AniController@aniroommng');
    Route::post('/SaveAniRoom', 'AniController@SaveAniRoom');
    Route::get('/getaniroomfortbl', 'AniController@getaniroomfortbl');
    Route::get('/deleteAniRoomByID/{id}', 'AniController@deleteAniRoomByID');
    Route::get('/getAniRoomByID/{id}', 'AniController@getAniRoomByID');
    Route::post('/EditAniRoom', 'AniController@EditAniRoom');
    Route::get('/aniannouncementadmin', 'AniController@aniannouncementadmin');
    Route::post('/saveannouncementani', 'AniController@saveannouncementani');
    Route::get('/gethtmlannouncementani', 'AniController@gethtmlannouncementani');
    Route::get('/aniannouncement', 'AniController@aniannouncement');
    Route::get('/cfmAniBookingByID/{id}', 'AniController@cfmAniBookingByID');
    Route::post('/setAccessAni', 'AniController@setAccessAni');
    Route::get('/anibooking', 'AniController@anibooking');
    Route::get('/getAniRoomforbooking', 'AniController@getAniRoomforbooking');
    Route::get('/getBookingbyAniRoomid/{id}', 'AniController@getBookingbyAniRoomid');
    Route::get('/getBookingbyAniRoomIDWithUsername/{id}', 'AniController@getBookingbyAniRoomIDWithUsername');
    Route::get('/getAniRoomByID/{id}', 'AniController@getAniRoomByID');
    Route::post('/anicheckTimeAvailable', 'AniController@anicheckTimeAvailable');
    Route::post('/BookAniRoom', 'AniController@BookAniRoom');
    Route::get('/getAniBookingByUserId', 'AniController@getAniBookingByUserId');
    Route::get('/myanibooking', 'AniController@myanibooking');
    Route::get('/deleteAniBookingByIDByUser/{id}', 'AniController@deleteAniBookingByIDByUser');
});

