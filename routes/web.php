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

use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get("categories" , "CategoryController@index")->name("categories.index");
    Route::get("categories/create" , "CategoryController@create")->name("categories.create");
    Route::post("categories/store" , "CategoryController@store")->name("categories.store");
    Route::get("categories/{category}/edit" , "CategoryController@edit")->name("categories.edit");
    Route::put("categories/{category}/update" , "CategoryController@update")->name("categories.update");
    Route::delete('categories/{category}/delete', "CategoryController@destroy")->name("categories.delete");
    
    //posts
    Route::get("posts" , "PostController@index")->name("posts.index");
    Route::get('posts/create' , "PostController@create")->name("posts.create");
    Route::post("posts/store" , "PostController@store")->name("posts.store");
    Route::delete('posts/{post}/delete', 'PostController@destroy')->name("posts.delete");
    Route::get('posts/trashed', 'PostController@trashed')->name("posts.trashed");
    Route::get("posts/{post}/edit" , "PostController@edit")->name("posts.edit");
    Route::put("posts/{post}/update" , "PostController@update")->name("posts.update");
    Route::put("posts/{post}/restore" , "PostController@restore")->name("posts.restore");

    //Tags
    Route::get("tags" , "TagController@index")->name("tags.index");
    Route::get("tags/create" , "TagController@create")->name("tags.create");
    Route::post("tags/store" , "TagController@store")->name("tags.store");
    Route::get("tags/{tag}/edit" , "TagController@edit")->name("tags.edit");
    Route::put("tags/{tag}/update" , "TagController@update")->name("tags.update");
    Route::delete('tags/{tag}/delete', "TagController@destroy")->name("tags.delete");
    
    
    //users
    Route::group(['middleware' => ['auth' , 'admin']], function () {
        Route::get("users" , "UserController@index")->name("users.index");
        Route::put("users/{user}make-admin" , "UserController@makeAdmin")->name("users.make-admin");    
        Route::get("users/{user}/profile" , "UserController@edit")->name("users.profile");
        Route::put("users/{user}/profile" , "UserController@update")->name("users.update-profile");
    });
    
});