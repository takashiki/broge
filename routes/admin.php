<?php

Route::get('/', ['uses' => 'HomeController@dashboard', 'as' => 'admin.index']);
