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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/edit/profile/{id}', 'HomeController@editprofile')->name('editprofile');
Route::post('/profile/update/', 'HomeController@update');

Route::get('/add/category/', 'Category\CategoryController@index')->name('add.category');
Route::post('/category/save/', 'Category\CategoryController@save');
Route::get('/category/manage/', 'Category\CategoryController@manage')->name('category.manage');
Route::get('/category/edit/{id}', 'Category\CategoryController@edit');
Route::post('/category/update/', 'Category\CategoryController@update');
Route::get('/category/delete/{id}', 'Category\CategoryController@delete');

Route::get('/add/company/', 'Company\CompanyController@index')->name('add.company');
Route::post('/company/save/', 'Company\CompanyController@save');
Route::get('/all/company/', 'Company\CompanyController@manage')->name('company.all');
Route::get('/company/edit/{id}', 'Company\CompanyController@editcompany');
Route::post('/company/update/', 'Company\CompanyController@update');
Route::get('/company/delete/{id}', 'Company\CompanyController@delete');

Route::post('/findSearch', 'HomeController@findSearch');


