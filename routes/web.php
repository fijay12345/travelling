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




Route::get('/', 'FrontpageController@index')->name('homepage');
Route::get('/search', 'FrontpageController@search')->name('search');
Route::get('post/{slug}', 'FrontpageController@view')->name('view-post');
Route::post('add-comment/{slug}', 'FrontpageController@addComment')->name('add-comment');
Route::get('delete-comment/{comment_id}', 'FrontpageController@destroyComment')->name('delete-comment');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@profile')->name('profile');
    Route::patch('/profile', 'ProfileController@updateProfile')->name('update-profile');
    Route::get('/change-password', 'ProfileController@changePassword')->name('change-password');
    Route::patch('/change-password', 'ProfileController@updatePassword')->name('update-password');
    
    Route::resource('posts', 'PostController');
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('delete/{slug}', 'PostController@destroy')->name('delete');
        Route::get('restore/{slug}', 'PostController@restore')->name('restore');
        Route::get('force-delete/{slug}', 'PostController@forceDelete')->name('force-delete');
    });

Route::get('categories', 'CategoryController@index')->name('categories.index'); 
Route::get('categories/create', 'CategoryController@create')->name('categories.create'); 
Route::post('categories', 'CategoryController@store')->name('categories.store'); 
});

