<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SetupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Authentication Route Start
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])
    ->name('store.login');
Route::get('/register', [AuthController::class, 'register'])
    ->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])
    ->name('storeRegister');

// Authentication Route End

Route::middleware('AdminAuth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/setup', [SetupController::class, 'setup']) ->name('setup');
    Route::get('/setup/edit/batch/{id}',[SetupController::class,'edit_batch'])->name('edit_batch');
    Route::post('/setup/update/batch',[SetupController::class,'updateBatch'])->name('update_batch');
    Route::get('setup/batch/delete/{id}',[SetupController::class,'deleteBatch'])->name('delete_batch');
    Route::post('/add/batch',[SetupController::class,'storeBatch'])->name('storeBatch');

    // Program Route Start
    Route::post('/add/program',[SetupController::class,'storeProgram'])->name('storeProgram');
    Route::get('/setup/edit/program/{id}',[SetupController::class,'edit_program'])->name('edit_program');
    Route::post('/setup/update/program',[SetupController::class,'updateProgram'])->name('update_program');
    Route::get('setup/program/delete/{id}',[SetupController::class,'deleteProgram'])->name('delete_program');
    // Program Route End

});
