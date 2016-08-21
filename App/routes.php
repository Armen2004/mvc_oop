<?php

use Core\Route;

Route::any("/", "WelcomeController");
Route::post("upload", "WelcomeController@upload");

//Route::get("user/create", "UserController@create@user");
//
//Route::get("user","UserController@index");
//
Route::get("about","AboutController");

