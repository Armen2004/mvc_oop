<?php

use Core\Route;

Route::any("/", "WelcomeController");
Route::post("add-new-style", "WelcomeController@newStyle");
Route::post("get-styles", "WelcomeController@getStyles");
Route::post("get-images", "WelcomeController@getImages");

//Route::post("upload", "WelcomeController@upload");
//Route::get("user/create", "UserController@create@user");
//
//Route::get("user","UserController@index");
//
//Route::get("about","AboutController");

