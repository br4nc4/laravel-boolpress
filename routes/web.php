<?php

use App\Http\Controllers\Admin\UserController;
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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware("auth")
->namespace("Admin") //indica la cartella dove si trovano il controller 
->name("admin.") //aggiunge prima del nome di ogni rotta questo prefisso
->prefix("admin") // aggiunge prima di ogni URI questo prefisso
->group(function () {
    Route::get('/', 'HomeController@index')->name('index');

    Route::get("/users", 'UserController@index')->name('users.index');
    Route::patch("/users/{user}", 'UserController@update')->name('users.update');
    Route::get("/users/{user}/edit", 'UserController@edit')->name('users.edit');

    Route::get("/categories/{category}/posts", 'CategoryController@posts')->name('categories.posts');

    Route::resource("posts", "PostController");
});