<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageRankController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/domains', [PageRankController::class, 'getDomains']);
