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

define('PAGINATION_COUNT',5);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    echo "<h1>Welcome to Laravel</h1>";
});

//Route Parameter
//required parameter
Route::get('/show-number/{id}', function ($id) {
    return $id;
})->name('a');

//option parameter
Route::get('/show-string/{id?}', function () {
    return "string";
})->name('b');

//Route NameSpace
Route::namespace('Front')->group(function () {
    // Controllers Within The "App\Http\Controllers\Front" Namespace
    Route::get('users', 'UserController@showUserName');
});

//Route Prefix
//Route::prefix('users')->group(function () {
//    Route::get('/', function () {
//        return "Work";
//    });
//});

//Route Group
Route::group(['prefix' => 'users'], function () {

    //set of route
    Route::get('/', function () {
        return "Work";
    });

});

Route::group(['namespace' => 'Admin'], function () {
    Route::get('second', 'SecondController@showString0');
    Route::get('second1', 'SecondController@showString1');
    Route::get('second2', 'SecondController@showString2');
    Route::get('second3', 'SecondController@showString3');
});

Route::get('login', function () {
    echo "You Must Login To Access This Page";
})->name('login');


Route::resource('news', 'NewsController');

//view
Route::get('index', 'Front\UserController@getIndex');

Route::get('landingPage', 'Front\UserController@getLandingPage');

Route::get('about-us', 'Front\UserController@getAboutUs');

Route::get('contact-us', 'Front\UserController@getContact');

//login and register
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//

Route::get('/dashboard', function () {
    return 'You Are Not Adult';
})->name('not.adult');


Route::get('/redirect/{service}', 'SocialController@redirect');


Route::get('/callback/{service}', 'SocialController@callback');

//Models
Route::get('fillable', 'CrudController@getOffers');

//mcamala
Route::group(
    ['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
        Route::get('create', 'CrudController@create');
        Route::get('in-active-offers', 'CrudController@getInactiveOffers');
        Route::get('in-valid-offers', 'CrudController@getInvalidOffers');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');
    });

});

//event and listener
Route::get('youtube', 'VideoController@getViewers')->middleware('auth');
########################Begin Ajax Offers########################
Route::group(['prefix' => 'ajax-offers', 'namespace' => 'Ajax'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offer.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});
########################End Ajax Offers#######################

################################Begin Custom Auth and guards##############################
Route::group(['namespace' => 'CustomAuth', 'middleware' => 'CheckAge'], function () {
    Route::get('adults', 'CustomAuthController@index');

});
################################End Custom Auth##############################

################Auth and Guards#####
Route::group(['namespace' => 'CustomAuth'], function () {
    Route::get('site', 'CustomAuthController@site')->middleware('auth:web')->name('site');
    Route::get('admin', 'CustomAuthController@admin')->middleware('auth:admin')->name('admin');
    Route::get('admin/login', 'CustomAuthController@adminLogin')->name('admin.login');
    Route::post('admin/login', 'CustomAuthController@checkAdminLogin')->name('save.admin.login');
});


#########################################Begin Relations Routes One To One########################
Route::group(['namespace' => 'Relations'], function () {
    Route::get('has-one', 'OneToOneRelationController@hasOne');
    Route::get('has-one-reverse', 'OneToOneRelationController@hasOneReverse');
    Route::get('get-user-has-phone', 'OneToOneRelationController@getUserHasPhone');
    Route::get('get-user-has-phone-withCode', 'OneToOneRelationController@getUserHasPhoneWithCode');
    Route::get('get-user-not-has-phone', 'OneToOneRelationController@getUserNotHasPhone');
});
#########################################End Relations one To one########################

#########################################Begin Relations Routes One To Many########################
Route::group(['namespace' => 'Relations'], function () {
    Route::get('has-one-to-many', 'OneToManyRelationController@getHospitalDoctors');
    Route::get('hospitals', 'OneToManyRelationController@hospitals')->name('hospitals.all');
    Route::get('hospital/delete/{hospital_id}', 'OneToManyRelationController@hospitalDelete')->name('hospitals.delete');
    Route::get('doctors/{hospital_id}', 'OneToManyRelationController@doctors')->name('doctors.hospitals');
    Route::get('hospital-has-doctors', 'OneToManyRelationController@getHospitalHasDoctor');
    Route::get('hospitals-has-only-male', 'OneToManyRelationController@getHospitalHasOnlyMale');
    Route::get('hospital-not-has-doctors', 'OneToManyRelationController@hospitalsNotHaveDoctors');
});
#########################################End Relations one To Many########################

#########################################Begin Relations Routes Many To Many########################
Route::group(['namespace' => 'Relations'], function () {
    Route::get('doctor-services','ManyToManyRelationController@getDoctorsServices');
    Route::get('all-doctors','ManyToManyRelationController@getDoctors');
    Route::get('services-doctor','ManyToManyRelationController@getServicesDoctors');
    Route::get('doctor/services/{doctor_id}', 'ManyToManyRelationController@getDoctorsServicesById')->name('doctors.services');
    Route::post('save-service', 'ManyToManyRelationController@saveService')->name('save.doctor.service');
});
#########################################end Relations Routes Many To Many########################
#########################################Begin Relations Routes Has One  Through###################
Route::group(['namespace' => 'Relations'], function () {
    Route::get('has-one-through','HasOneThroughRelationController@getPatientDoctor');
});
#########################################End Relations Routes Has One  Through########################

##################Begin collection################################33
Route::group(['namespace'=>'Collection'],function (){
    Route::get('collectionTut','CollectionController@index');
    Route::get('each','CollectionController@allOffers');
});

##################End collection################################33
