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
// Route::get('/addmore', function () {
//     return view('addmore');
// });

Route::get('/addmore','PagesController@addmore');
Route::get('/cricket','PagesController@cricket');
Route::get('/cricket/compute','PagesController@getscores');
Route::get('/cricket/test','PagesController@test');
Route::get('/cricket/enterid','PagesController@enterid');
Route::get('/tasks','TasksController@index');
Route::get('/task/add','TasksController@add');
Route::post('task/save','TasksController@save');
Route::post('ajax', 'TasksController@save')->name('ajaxRequest.post');
Route::resource('resources','ResourceController');  

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/progress','PagesController@progress');
Route::get('/progress/update','ProgressCountController@increase');

Route::resource('posts', 'PostsController');