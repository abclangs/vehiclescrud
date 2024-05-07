<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VehicleCRUDController;
Route::resource('vehicles', VehicleCRUDController::class);

Route::get('/', function () {
    return view('welcome');
});
