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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/redirect', 'SocialAuthGoogleController@redirect');

Route::get('/callback', 'SocialAuthGoogleController@callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user/activation/{activation_code}', 'Auth\RegisterController@activateUser')->name('user.activate');
//Route::get('register/verify/{code}', 'Auth\RegisterController@verify');

Route::get('/chat', function () {
    return view('welcome_chat');
});

Route::get('/send', 'SendMessageController@index')->name('send');

Route::post('/postMessage', 'SendMessageController@sendMessage')->name('postMessage');


