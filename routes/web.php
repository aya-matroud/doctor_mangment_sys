<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[App\Http\Controllers\HomeController::class,'index']);
Route::get('/home',[App\Http\Controllers\HomeController::class,'redirect'])->middleware('auth');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/add_doctor_view',[App\Http\Controllers\AdminController::class,'addview']);
Route::post('/upload_doctor',[App\Http\Controllers\AdminController::class,'upload']);
Route::post('/appointment',[App\Http\Controllers\HomeController::class,'appointment'])->middleware('auth');

Route::get('/myappointment',[App\Http\Controllers\HomeController::class,'myappointment']);

Route::get('/cancel_appoint/{id}',[App\Http\Controllers\HomeController::class,'cancelappoint']);

Route::get('/showappointment',[App\Http\Controllers\AdminController::class,'showappointment']);

Route::get('/approved/{id}',[App\Http\Controllers\AdminController::class,'approved']);

Route::get('/canceled/{id}',[App\Http\Controllers\AdminController::class,'canceled']);

Route::get('/showdoctors',[App\Http\Controllers\AdminController::class,'showdoctors']);
Route::get('/deletedoctor/{id}',[App\Http\Controllers\AdminController::class,'deletedoctor']);

Route::get('/editdoctor/{id}',[App\Http\Controllers\AdminController::class,'editdoctor']);
Route::post('/updatedoctor/{id}',[App\Http\Controllers\AdminController::class,'updatedoctor']);


