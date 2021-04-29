<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
	Route::get('login',[AdminController::class, 'loginForm']);
	Route::post('login',[AdminController::class, 'store'])->name('admin.login');
	
});

Route::middleware(['auth:sanctum,admin', 'verified'])->group(function () {
	Route::get('/admin/dashboard', [CompanyController::class, 'index'])->name('dashboard');
	Route::get('admin/add-company',[CompanyController::class, 'add_company'])->name('admin.company');
	Route::post('admin/add-company',[CompanyController::class, 'company_save'])->name('compay.add');
	Route::get('admin/add-company/{id}',[CompanyController::class, 'add_company'])->name('company.update');
	Route::get('admin/company/delete/{id}',[CompanyController::class,'company_delete'])->name('company.delete');


	Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('employee');
	Route::get('admin/add-employee',[EmployeeController::class, 'add_employee'])->name('admin.employee');
	Route::post('admin/add-employee',[EmployeeController::class, 'employee_save'])->name('employee.add');
	Route::get('admin/add-employee/{id}',[EmployeeController::class, 'add_employee'])->name('employee.update');
	Route::get('admin/employee/delete/{id}',[EmployeeController::class,'employee_delete'])->name('employee.delete');
});

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin Routes
Route::get('admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
