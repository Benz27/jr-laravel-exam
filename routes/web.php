<?php

use App\Http\Controllers\BrgysController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// root route redirects to patient instead. patient is the main landing page
// the views uses master.blade.php as the root/parent layout
Route::redirect('/', '/patient');
// The CityController class is where the comments located documenting the flow/behaviors of the controllers.
// They all behave similarly with others having bit of additional functionalities
Route::get('/city', [CityController::class, 'index']); //table page
Route::get('/city/edit/{id}', [CityController::class, 'edit']); //edit page
Route::get('/city/create', [CityController::class, 'create']); //create page
Route::get('/city/view/{id}', [CityController::class, 'show']); //viewing page

Route::post('/city/store', [CityController::class, 'store']); //storing/creating end point
Route::put('/city/update/{id}', [CityController::class, 'update']); //update end point
Route::delete('/city/destroy/{id}', [CityController::class, 'destroy']); //destroy/deleting end point
// The same is true for the rest below

// ========================================================
Route::get('/brgys', [BrgysController::class, 'index']);
Route::get('/brgys/edit/{id}', [BrgysController::class, 'edit']);
Route::get('/brgys/create', [BrgysController::class, 'create']);
Route::get('/brgys/view/{id}', [BrgysController::class, 'show']);

Route::post('/brgys/store', [BrgysController::class, 'store']);
Route::put('/brgys/update/{id}', [BrgysController::class, 'update']);
Route::delete('/brgys/destroy/{id}', [BrgysController::class, 'destroy']);

// ========================================================
Route::get('/patient', [PatientController::class, 'index']);
Route::get('/patient/edit/{id}', [PatientController::class, 'edit']);
Route::get('/patient/create', [PatientController::class, 'create']);
Route::get('/patient/view/{id}', [PatientController::class, 'show']);

Route::post('/patient/store', [PatientController::class, 'store']);
Route::put('/patient/update/{id}', [PatientController::class, 'update']);
Route::delete('/patient/destroy/{id}', [PatientController::class, 'destroy']);

Route::get('/patient/search/', [PatientController::class, 'search']); //search page
Route::put('/patient/search', [PatientController::class, 'searchPatient']); //search payload end point

Route::get('/reports/{type}/{city_id}/{brgys_id}', [PatientController::class, 'reports']); //reports page with arguments
Route::get('/reports/{type}/', [PatientController::class, 'reports']); //reports page
Route::put('/reports/{type}/', [PatientController::class, 'getReports']); //reports end point for sending argument payload

Route::redirect('/reports/{type}/{city_id}', '/reports/{type}/'); //redirect
Route::redirect('/reports', '/'); //redirect

// Route::get('/view/{type}/{id}', [ViewController::class, 'search']);