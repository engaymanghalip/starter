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


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');

Route::get('/', function (){
    return 'Home';
});

Route::get('/dashboard',function (){
    return 'dashboard';
});

Route::get('fillable','CrudController@getoffers');


Route::group(['prefix' =>LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function (){
    Route::group(['prefix' => 'offers'],function (){
        Route::get('create','CrudController@create');
        Route::post('store','CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}','CrudController@editOffer');
        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');

        Route::get('all','CrudController@getAlloffers');
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
    Route::get('youtube','CrudController@getVideo');
});

