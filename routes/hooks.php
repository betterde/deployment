<?php

Route::get('history', 'DeploymentController@history');
Route::post('webhook', 'DeploymentController@webhook');
