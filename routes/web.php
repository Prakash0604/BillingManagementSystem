<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BatchTypeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\courseFeeController;
use App\Http\Controllers\FeeStructure;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\particularcontroller;
use App\Http\Controllers\TestController;

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

    Route::get('/test',function(){
        return "Hello world";
    });
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

    // Unique select option in student Edit Start
    Route::get('students/edit/getprogram/{id}',[StudentsController::class,'getprogram']);
    Route::get('students/edit/getsemester/{id}',[StudentsController::class,'getsemester']);
    // Unique select option is student EditEnd

    // Student Import And Export Format

    Route::get('students/view/exportwithimport',[StudentsController::class,'getImportExport'])->name('getImportExport');
    Route::get('students/view/export',[StudentsController::class,'export'])->name('student.export');
    Route::post('students/view/import',[StudentsController::class,'import'])->name('student.import');

    Route::get('students/view/getprogram/{id}',[StudentsController::class,'getprogram'])->name('export.getprogram');
    Route::get('students/view/getsemester/{id}',[StudentsController::class,'getsemester'])->name('export.getsemester');

    // Student Import And Export Format


    // Fee particualr Start
    Route::get('billing/particular',[particularcontroller::class,'particular'])->name('particular');
    Route::post('billing/particular',[particularcontroller::class,'storeparticular'])->name('store.particular');
    Route::get('/billing/particular/data/{id}',[particularcontroller::class,'particulardata']);
    Route::post('/billing/particular/update',[particularcontroller::class,'updateParticular']);
    Route::get('/billing/particular/delete/{id}',[particularcontroller::class,'deleteParticular']);
    // Route::get('convert/kgtogram/{data}',[particularcontroller::class,'kgtogram']);


    // BatchType Start
    Route::get('/billing/batchtype',[BatchTypeController::class,'index'])->name('batch_type');
    Route::get('/billing/batchtype/create',[BatchTypeController::class,'create']);
    Route::post('billing/batchtype/store',[BatchTypeController::class,'store']);
    Route::post('/billing/batchtype/update',[BatchTypeController::class,'update']);
    Route::get('/billing/batchtype/delete/{id}',[BatchTypeController::class,'delete']);

    Route::get('/test',[TestController::class,'test']);
    // Fetch Data
    Route::get('billing/data/get/{id}',[BatchTypeController::class,'data']);
    // BatchType End

    // Fee particualr End

    // Route::get('report/batchwise',[ReportController::class,'batchwiseReport'])->name('batchWiseReport');
    Route::get('report/batchwise',[ReportController::class,'show'])->name('batchWiseReport');
    Route::get('report/batch/data/{id}',[ReportController::class,'dataBatchwise'])->name('dataBatchwise');
    Route::get('report/semester/data/{id}',[ReportController::class,'dataSemesterwise'])->name('dataSemesterwise');
    Route::get('report/batchwise/report/get',[ReportController::class,'reportBatchwise'])->name('reportBatchwise');
    // Route::get('/test',[ReportController::class,'test']);


    // Fee Structure
    Route::get('billing/fee_structure',[FeeStructureController::class,'index_courseFee']);
    Route::get('billing/fee_structure/create',[FeeStructureController::class,'create_courseFee']);
    Route::post('billing/fee_structure/store',[FeeStructureController::class,'store_courseFee']);
    Route::get('billing/delete/coursefee/{id}',[FeeStructureController::class,'delete_coursefee']);


    // Fetch Data in fee structure
    Route::get('billing/fee_structure/program/data/get/{id}',[FeeStructureController::class,'fetchProgramData']);
    Route::get('billing/fee_structure/semester/data/get/{id}',[FeeStructureController::class,'fetchSemesterData']);
    Route::get('billing/fee/students/data/get/{id}',[BillController::class,'fetchStudentData']);



    Route::get('billing/fee/program/data/{id}',[BillController::class,'fetchProgramData'])->name('fetch_program_data');
    Route::get('billing/fee/semester/data/{id}',[BillController::class,'fetchSemesterData'])->name('fetch_semester_data');;
    Route::get('billing/fee/students/data/{id}',[BillController::class,'fetchStudentData'])->name('fetch_student_data');;

    Route::get('billing/fee/receipt',[BillController::class,'index']);

});
