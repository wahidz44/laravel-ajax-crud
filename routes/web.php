<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

//Employee Route
Route::get('/employee',[EmployeeController::class,'index']);
Route::post('/employee',[EmployeeController::class,'store'])->name('employee');
Route::get('/fetch-employee',[EmployeeController::class,'fetchEmployee'])->name('fetch.employee');

Route::get('/edit-employee/{id}',[EmployeeController::class,'editEmployee'])->name('edit.employee');
Route::post('/update-employee/{id}',[EmployeeController::class,'updateEmployee'])->name('update.employee');

Route::delete('/employee-delete/{id}',[EmployeeController::class,'destroy'])->name('employee.delete');

//Student Route
Route::get('/student',[StudentController::class,'index']);
Route::post('/student',[StudentController::class,'store'])->name('student');
Route::get('/student-fetch/',[StudentController::class,'fetchStudent'])->name('student.fetch');
Route::get('/student-delete/{id}',[StudentController::class,'deleteStudent'])->name('student.delete');

Route::get('/student-edit/{id}',[StudentController::class,'editStudent'])->name('student.edit');
Route::post('/student-update/{id}',[StudentController::class,'updateStudent'])->name('student.update');
