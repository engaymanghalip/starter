<?php

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


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {
    return 'Home';
});

Route::get('/dashboard', function () {
    return 'not adualt مابش دخله';
})->name('not.adualt');

Route::get('fillable', 'CrudController@getoffers');


Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');

        Route::get('all', 'CrudController@getAlloffers')->name('offers.all');
    });
    //  Route::get( 'store','CrudController@store');

//Route::group(['prefix'=>'offers'],function (){
//    //Route::get('store','CrudController@store');
//
//    Route::group(['prefix'=>  LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){
//        Route::get('create','CrudController@create');
//    });
//
//
//    Route::post('store','CrudController@store')->name('offers.store');
    Route::get('youtube', 'CrudController@getVideo')->middleware('auth');
});

####### ##################################### start ajax ##############################
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});
####### ##################################### end ajax ##############################

########## Begin Authentication $$ Gusrds #######################
Route::group(['middleware' => 'CheckAge', 'namespace' => 'Auth'], function () {
    Route::get('adult', 'CustomAuthController@Adualt')->name('adult');
});

Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin\login', 'Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');

########## Begin Authentication $$ Gusrds #######################


############# begin relation routs ######################
Route::get('has-one', 'Relation\RelationsController@hasOneRelation');

Route::get('has-one-reverse', 'Relation\RelationsController@hasOneRelationReverse');

Route::get('get-user-has-phone', 'Relation\RelationsController@getUserHasPhone');

Route::get('get-user-not-has-phone', 'Relation\RelationsController@getUserNotHasPhone');

Route::get('get-user-has-phone-with-condition', 'Relation\RelationsController@getUserphonewithcondition');

############# end  relation routs ######################


############# start one to many  relation routs ######################

Route::get('hospital-has-many', 'Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals', 'Relation\RelationsController@hospitals')->name('hospitals.all');

Route::get('doctors/{hospital_id}', 'Relation\RelationsController@doctors')->name('hospital.doctors');

Route::get('hospitals/{hospital_id}', 'Relation\RelationsController@deleteHospital')->name('hospital.delete');

Route::get('hospitals-has-doctors', 'Relation\RelationsController@hospitalsHasDoctor');

Route::get('hospitals-has-doctors-male', 'Relation\RelationsController@hospitalsHas_only_Female_Doctors');

Route::get('hospitals-have-not-doctors', 'Relation\RelationsController@hospitalsHaveNotDoctors');

############# end one to many  relation routs ######################

############# begin many to many  relation routs ######################

Route::get('doctors-services', 'Relation\RelationsController@getDoctorsServices');

Route::get('services-doctors', 'Relation\RelationsController@getServicesDoctors');

Route::get('doctors/services/{doctor_id}', 'Relation\RelationsController@getDoctorsServicesById')->name('doctors.services');

Route::post('saveService-to-doctors/services', 'Relation\RelationsController@saveServiceToDoctors')->name('save.doctors.services');

############# end many to many  relation routs ######################
