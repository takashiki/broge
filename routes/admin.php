<?php

// Dashboard
Route::get('/', ['uses' => 'HomeController@dashboard', 'as' => 'admin.index']);

// Article management
Route::resource('article', 'ArticleController', ['except' => ['show']]);