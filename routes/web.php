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
//
Route::get('/migrate', function () {
    Artisan::call('migrate');
    Artisan::call('cache:clear');
});
Route::get('/addmore','PagesController@addmore')->middleware('auth');
Route::get('/cricket','PagesController@cricket');
Route::post('/cricket/compute/','PagesController@getscores');
Route::get('/cricket/test','PagesController@test');
Route::get('/cricket/enterid','PagesController@enterid');
Route::get('/cricket/choosematch','PagesController@choosematch');
Route::get('/tasks','TasksController@index')->middleware('auth');
Route::get('/task/add','TasksController@add')->middleware('auth');
Route::post('task/save','TasksController@save')->middleware('auth');
Route::post('ajax', 'TasksController@save')->name('ajaxRequest.post')->middleware('auth');
Route::resource('resources','ResourceController')->middleware('auth');  

Auth::routes(['register' => false,
'cricket' => false, // Password Reset Routes...
'cricket/compute' => false,
'cricket/enterid' => false
]);


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/progress','PagesController@progress')->middleware('auth');
Route::get('/progress/update','ProgressCountController@increase')->middleware('auth');

Route::post('/checkapi','PagesController@checkapi');

Route::get('/.well-known/microsoft-identity-association.json','PagesController@checkapi');

Route::get('/.well-known/microsoft-identity-association.','PagesController@checkapi');

Route::get('/.well-known/microsoft-identity-association','PagesController@checkapi');




Route::resource('posts', 'PostsController')->middleware('auth');