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
    return redirect()->route('login');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/home', 'HomeController@index')->name('home');



//Coach Routes//////////////////////////////////////////////////////////////////////
Route::get('/dash/project', 'NavigationController@project')->name('project');
Route::get('/dash/team', 'NavigationController@team')->name('team');
Route::get('/dash/questions', 'NavigationController@questions')->name('questions');
Route::get('/dash/answers', 'NavigationController@answers')->name('answers');
Route::get('/dash/statistics', 'NavigationController@statistics')->name('statistics');
////////////////////////////////////////////////////////////////////////////////////


//Reqular Users Routes////////////////////////////////////////////////////////////////
Route::get('/dash/member', 'NavigationController@member')->name('member');
////////////////////////////////////////////////////////////////////////////////////


//Admin Routes////////////////////////////////////////////////////////////////
Route::get('/dash/admin', 'NavigationController@admin')->name('admin');
////////////////////////////////////////////////////////////////////////////////////


//Coach Forms Routes////////////////////////////////////////////////////////////////
Route::post('/add_member', 'NavigationController@add_member')->name('add_member');
Route::post('/remove_member', 'NavigationController@remove_member')->name('remove_member');

Route::post('/create_questionnaire', 'NavigationController@create_questionnaire')->name('create_questionnaire');
Route::post('/create_team', 'NavigationController@create_team')->name('create_team');
Route::post('/create_project', 'NavigationController@create_project')->name('create_project');

Route::post('/answer_question', 'NavigationController@answer_question')->name('answer_question');

Route::post('/make_coach', 'NavigationController@make_coach')->name('make_coach');
Route::post('/remove_coach', 'NavigationController@remove_coach')->name('remove_coach');

Route::post('/delete_project', 'NavigationController@delete_project')->name('delete_project');
Route::post('/delete_team', 'NavigationController@delete_team')->name('delete_team');
////////////////////////////////////////////////////////////////////////////////////////////////


//Admin Form Routes////////////////////////////////////////////////////////////////////////////////////
Route::post('/make_head_coach', 'NavigationController@make_head_coach')->name('make_head_coach');
Route::post('/remove_head_coach', 'NavigationController@remove_head_coach')->name('remove_head_coach');
////////////////////////////////////////////////////////////////////////////////////


