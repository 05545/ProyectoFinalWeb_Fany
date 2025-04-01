<?php

use App\Http\Controllers\GendersPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.homePage');
});

Route::get('/genders', [GendersPublicController::class,'Gender'])->name('client.gender');
