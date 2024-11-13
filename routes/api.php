<?php

use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/employees',  [EmployeesController::class, 'index']) ;
Route::post('/employees',  [EmployeesController::class, 'store']) ;
Route::get('/employees/{id}',  [EmployeesController::class, 'show']) ;
Route::put('/employees/{id}',  [EmployeesController::class, 'update']) ;
Route::delete('/employees/{id}',  [EmployeesController::class, 'delete']) ;
Route::get('/employees/search/{name}',  [EmployeesController::class, 'search']) ;
Route::get('/employees/status/active',  [EmployeesController::class, 'active']) ;
Route::get('/employees/status/inactive',  [EmployeesController::class, 'inactive']) ;
Route::get('/employees/status/terminated',  [EmployeesController::class, 'terminated']) ;

