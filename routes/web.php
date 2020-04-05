<?php

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


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/help/{id}', 'WelcomeController@show')->name('show');

Route::get('/list/{id}/donations', 'DonationController@index')->name('donation');
Route::post('/list/{id}/donations', 'DonationController@store')->name('donation-store');
Route::get('/donation/{id}', 'DonationController@edit')->name('donation-edit');
Route::post('/donation/{id}', 'DonationController@update')->name('donation-update');
Route::get('/files/{uuid}/download', 'DonationController@download')->name('download');


Route::get('/list', 'HomeController@list')->name('list');
Route::get('/list/{id}/edit', 'HomeController@edit')->name('edit');
Route::post('/list/{id}/edit', 'HomeController@update')->name('update');

Route::get('/create', 'HomeController@create')->name('create');
Route::post('/create', 'HomeController@store')->name('store');

Route::get('/banks', 'BankController@index')->name('banks');
Route::get('/bank/create', 'BankController@create')->name('bank-create');
Route::post('/bank/create', 'BankController@store')->name('bank-store');
Route::get('/bank/{id}/edit', 'BankController@edit')->name('bank-edit');
Route::post('/bank/{id}/edit', 'BankController@update')->name('bank-update');
Route::post('/banks', 'BankController@destroy')->name('bank-destroy');

Route::get('/cities', 'CityController@index')->name('cities');
Route::get('/city/create', 'CityController@create')->name('city-create');
Route::post('/city/create', 'CityController@store')->name('city-store');
Route::get('/city/{id}/edit', 'CityController@edit')->name('city-edit');
Route::post('/city/{id}/edit', 'CityController@update')->name('city-update');
Route::post('/cities', 'CityController@destroy')->name('city-destroy');
