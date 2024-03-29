<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile
    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    // Projects
    Route::get('/project/list', 'ProjectController@getProjectList');
    Route::get('/project/detail', 'ProjectController@getProjectById');
    Route::post('/project/update', 'ProjectController@updateProjectById');
    Route::post('/project/delete', 'ProjectController@deleteProjectById');
    Route::post('/project/create', 'ProjectController@createProject');

    // Users
    Route::get('user/list', 'UserController@getUserList');
    Route::post('user/create', 'UserController@create');
    Route::post('user/update', 'UserController@updateUserById');

    // Dashboard
    Route::get('dashboard', 'DashboardController@getDashboardData');

    // Role
    Route::get('role/list', 'RoleController@getRoleList');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
