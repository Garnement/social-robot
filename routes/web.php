<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// ->name permet de renommer la route
Route::get('/', 'FrontController@index')->name('home');

// On récupère la valeur d'ID, (slug est facultatif), on renvoi vers le FrontController
// sur la fonction showRobotsByCat qui elle même renvoi vers 'single.blade.php'
Route::get('/category/{id}/{slug?}', 'FrontController@showRobotsByCat')->name('category');

Route::get('/user/{id}/{grade?}', 'FrontController@showUserProfile');

Route::get('/robot/{id}', 'FrontController@showRobotById')->name('robot');

Route::get('/robot/user/{id}', 'FrontController@showRobotsByUser')->name('user');

Route::get('/tags/{id}', 'FrontController@showRobotsByTags')->name('tags');

//Route::get('/auth', 'LoginController@login')->name('auth');

// Any permet de traiter soit POST soit GET
Route::any('login', 'LoginController@login');

Route::any('/logout', 'LoginController@logout')->name('logout');

/*Groupe de routes avec un prefix et un middleware
qui s'appliquera dans toutes les routes de ce groupe */

Route::group(['prefix' =>'dashboard', 'middleware' => 'auth'], function() {

    Route::get('profile', 'Admin\DashboardController@profile');
//equivaut a route::get('dashboard/profile', 'Admin\DashboardController@profile')->middleware('auth');

    Route::resource('robot', 'Admin\RobotController');  // Routes du RESTfull qui permettront de faire le CRUD de la ressource robots en base de données
});
