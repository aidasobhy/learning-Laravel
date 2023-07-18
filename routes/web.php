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
    Route::get('users','UserController@showUserName');
});

//Route Prefix
//Route::prefix('users')->group(function () {
//    Route::get('/', function () {
//        return "Work";
//    });
//});

//Route Group
Route::group(['prefix'=>'users'],function (){

    //set of route
    Route::get('/',function (){
        return "Work";
    });

});

Route::group(['namespace'=>'Admin'],function (){
    Route::get('second','SecondController@showString0');
    Route::get('second1','SecondController@showString1');
    Route::get('second2','SecondController@showString2');
    Route::get('second3','SecondController@showString3');
});

Route::get('login',function (){
    echo "You Must Login To Access This Page";
})->name('login');


Route::resource('news','NewsController');

//view
Route::get('index','Front\UserController@getIndex');

Route::get('landingPage','Front\UserController@getLandingPage');

Route::get('about-us','Front\UserController@getAboutUs');

Route::get('contact-us','Front\UserController@getContact');

//login and register
Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
