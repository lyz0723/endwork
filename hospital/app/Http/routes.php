<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index','IndexController@index');
Route::get('find_doctor','IndexController@find_doctor');
Route::get('request_appointment','IndexController@request_appointment');
Route::get('contact_us','IndexController@contact_us');
Route::get('Care_Services','IndexController@Care_Services');
Route::get('our_doctors','IndexController@our_doctors');
Route::get('patients','IndexController@patients');
Route::get('visitiors','IndexController@visitiors');
Route::get('health_information','IndexController@health_information');
Route::get('about_us','IndexController@about_us');
//个人中心
Route::get('person','PersonController@index');
Route::get('menu','PersonController@menu');
Route::get('main','PersonController@main');
//用户登录页面
Route::get('Userlogin','LoginController@index');
//判断用户登录
Route::post('login_do','LoginController@login_do');
//微信扫码登录
Route::get('weixin','LoginController@weixin');
//获取微信公众号code
Route::get('code','LoginController@code');
//用户注册页面
Route::get('Userregister','RegisterController@index');
//验证码
Route::get('kit/captcha/{tmp}', 'CodeController@captcha');



?>