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
//Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix'=>'dashboard','middleware'=>['auth','subscription']], function(){
    Route::get('/','HomeController@index');
    Route::resource('projects','ProjectController');
});
Route::group(['prefix'=>'user', 'middleware'=>['auth','subscription']], function(){
    Route::get('profile', 'ProfileController@profile');
    Route::post('profile', 'ProfileController@saveprofile');
    Route::get('password', 'ProfileController@password');
    Route::post('password', 'ProfileController@savepassword');
    Route::post('savephoto', 'ProfileController@savephoto');
    
});

Route::get('/payment/{plan?}','PayController@payment')->middleware('auth');

// API ROUTES
Route::group(['prefix'=>'napi','middleware'=>['auth']], function(){
   Route::get('listProjects','ProjectController@listProjects');
   Route::get('listTasks/{project}','TaskController@listTasks');
   Route::post('startTimer','TimeFrameController@start');
   Route::put('stopTimer/{timeFrame}','TimeFrameController@stop');
   Route::put('updateTimer','TimeFrameController@updateTimer');
   Route::get('clientslist', 'ClientController@getClientsList');
   Route::post('saveProject', 'ProjectController@store');
//   SUBSCRIPTION
});

Route::group(['prefix'=>'company','middleware'=>['auth','subscription']], function(){
    Route::get('team','CompanyController@team');
    Route::post('sendInvite','CompanyController@sendInvite');
});

Route::post('/napi/subscribe','PayController@subscribe');
Route::post('/napi/unsubscribe','PayController@unsubscribe');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::post('register', 'AuthController@register');
Route::post('registerCompany', 'AuthController@registerCompany');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/fuck',function(){
    return view('auth');
});

Route::get('/testflip', function(){
    return view('flip');
});
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
    Route::resource('projects','ProjectController');
}); 
