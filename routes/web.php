<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\StudentsController;

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
Route::get('/', [AuthController::class, 'register'])
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
    Route::get('setup/program/select/filter/{id}',[SetupController::class,'selectProgram'])->name('selectProgram');
    Route::post('setup/current/runing/semester',[SetupController::class,'runningSemester'])->name('runningSemester');
    Route::get('setup/current/running/edit/{id}',[SetupController::class,'editSemester'])->name('editSemester');
    Route::get('/setup/current/running/program/delete/{id}',[SetupController::class,'deleteSemester'])->name('deleteSemester');
    // Program Route End


    Route::get('/students',[StudentsController::class,'index'])->name('students.index');
    Route::get('/students/create',[StudentsController::class,'createStudent'])->name('students.create');
    Route::post('/students/create',[StudentsController::class,'store'])->name('students.store');
    Route::get('/students/{id}',[StudentsController::class,'show'])->name('students.show');
    Route::get('/students/edit/{id}',[StudentsController::class,'edit'])->name('students.edit');
    Route::post('/students/edit/{id}',[StudentsController::class,'update'])->name('students.update');
    Route::get('/students/delete/{id}',[StudentsController::class,'destroy'])->name('students.destory');


    // Unique select option is student add Start
    Route::get('students/getprogram/{id}',[StudentsController::class,'getprogram'])->name('getprogram');
    Route::get('students/getsemester/{id}',[StudentsController::class,'getsemester'])->name('getsemester');
    // Unique select option is student add End
});
