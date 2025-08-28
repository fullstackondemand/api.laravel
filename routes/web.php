<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => config('app.name') . " RESTful API");