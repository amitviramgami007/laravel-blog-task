<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function()
{
    // Dashboard Route
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

    // Users Route
    Route::resource('users', 'UserController');
    Route::post('send-welcome-email/', 'UserController@sendWelcomeEmail');

    // Posts Route
    Route::resource('posts', 'PostController');

    // Categories Route
    Route::resource('categories', 'CategoryController');

    // Profile Routes
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::post('/update-profile-info', 'AdminController@updateProfileInfo')->name('updateProfileInfo');
    Route::post('/change-password', 'AdminController@changePassword')->name('changePassword');
    Route::post('/update-avatar', 'AdminController@updateAvatar')->name('updateAvatar');
});
