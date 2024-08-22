<?php

use App\Http\Controllers\BrgysController;
use Illuminate\Support\Facades\Route;
// for testing


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('/city', [CityController::class, 'index']);
// Route::get('/city/{id}', [CityController::class, 'edit']);
// Route::post('/city', [CityController::class, 'store']);
// Route::put('/city/{id}', [CityController::class, 'update']);
Route::get('/brgys/by/city/{id}', [BrgysController::class, 'getByCity']);
// Route::put('/city/{id}', function(Request $r, $id){
//     $city = City::find($id);
//     $city->name = $r->name;
//     $city->update();
//     return $city;
// });
