<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/user', 'Auth\LoginController@showUserLoginForm');
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm');
Route::post('/login/user', 'Auth\LoginController@userLogin');
Route::post('/login/employee', 'Auth\LoginController@employeeLogin');

Route::view('/user', 'user');
Route::view('/employee', 'employee');
//Route::view('/users', 'users');
//Route::view('/employees', 'employees');


Route::namespace('Admin')->group(function () {
    Route::group(['middleware' => ['superadmin']], function () {
        Route::delete('/user/{id}', 'UserController@delete')->name('user.delete');
        Route::delete('/employee/{id}', 'EmployeeController@delete')->name('employee.delete');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/user', 'UserController@create')->name('users.create');
        Route::post('/user', 'UserController@store')->name('users.store');
        Route::get('/user/check-email', 'UserController@checkEmail')->name('users.chekEmail');
        Route::get('/users', 'UserController@index')->name('admin.users.index');

        Route::get('/employee-create', 'EmployeeController@create')->name('employees.create');
        Route::post('/employee-create', 'EmployeeController@store');
        Route::get('/employee/check-email', 'EmployeeController@checkEmail')->name('employees.chekEmail');
        Route::get('/employees', 'EmployeeController@index')->name('admin.employee.index');
        Route::post('/employee-edit/{id}/info', 'EmployeeController@updateInfo')->name('admin.employee.update.info');
        Route::get('/employee-edit/{id}/info', 'EmployeeController@editInfo')->name('admin.employee.edit.info');
        Route::get('/employee-edit/{id}/password', 'EmployeeController@editPassword')->name('admin.employee.edit.password');
        Route::post('/employee-edit/{id}/password', 'EmployeeController@updatePassword');
        Route::post('/employee-edit/{id}/active', 'EmployeeController@activateOrDeactivate')->name('employee.active');

    });

    Route::group(['middleware' => ['user']], function () {
        Route::post('/user/{id}/info', 'UserController@updateInfo')->name('user.update.info');
        Route::get('/user/{id}/info', 'UserController@editInfo')->name('user.edit.info');
        Route::get('/user/{id}/password', 'UserController@editPassword')->name('user.edit.password');
        Route::post('/user/{id}/password', 'UserController@updatePassword');
    });
});

Route::namespace('Admin')->group(function () {
//-------------------------------Contract-----------------------------------------------------------
    Route::get('/employee/{id}/contract', 'ContractController@index')->name('contracts.index');
    Route::get('/contract/{id}/info', 'ContractController@editInfo')->name('contract.edit.info');
    Route::post('/contract/{id}/info', 'ContractController@updateInfo')->name('contract.update.info');
    Route::get('/contract', 'ContractController@create')->name('contract.create');
    Route::post('/contract', 'ContractController@store');
    Route::get('/contract/{id}/download', 'ContractController@download')->name('contract.download');
    Route::get('/contract/{id}/view', 'ContractController@view')->name('contract.view');
    Route::delete('/contract/{id}', 'ContractController@delete')->name('contract.delete');

//---------------------------Payslip-----------------------------------------------------------------
    Route::get('/employee/{id}/payslip', 'PayslipController@index')->name('payslips.index');
    Route::get('/payslip/{id}/info', 'PayslipController@editInfo')->name('payslip.edit.info');
    Route::post('/payslip/{id}/info', 'PayslipController@updateInfo')->name('payslip.update.info');
    Route::get('/payslip', 'PayslipController@create')->name('contract.create');
    Route::post('/payslip', 'PayslipController@store');
    Route::get('/payslip/{id}/download', 'PayslipController@download')->name('payslip.download');
    Route::get('/payslip/{id}/view', 'PayslipController@view')->name('payslip.view');
    Route::delete('/payslip/{id}', 'PayslipController@delete')->name('payslip.delete');
//----------------------------------------------------------------------------
    Route::get('/employee/{id}/feedback', 'FeedbackController@index')->name('feedbacks.index');
    Route::get('/feedback/{id}/info', 'FeedbackController@editInfo')->name('feedback.edit.info');
    Route::post('/feedback/{id}/info', 'FeedbackController@updateInfo')->name('feedback.update.info');
    Route::get('/feedback', 'FeedbackController@create');
    Route::post('/feedback', 'FeedbackController@store');
    Route::get('/feedback/{id}/download', 'FeedbackController@download')->name('feedback.download');
    Route::get('/feedback/{id}/view', 'FeedbackController@view')->name('feedback.view');
    Route::delete('/feedback/{id}', 'FeedbackController@delete')->name('feedback.delete');
//-----------------------Vacations----------------------------------
    Route::get('/vacations', 'VacationController@index')->name('vacation.index');
    Route::post('/vacation/{id}/accept', 'vacationController@accept')->name('vacation.active');
    Route::post('/vacation/{id}/refuse', 'vacationController@refuse')->name('vacation.refuse');
    Route::post('/vacation/{id}/edit', 'vacationController@refuse')->name('vacation.refuse');


//---------------------bonus edit---------------------------------
    Route::post('/employee/{id}/bonus', 'EmployeeController@updateBonus')->name('employee.update.bonus');
    Route::get('/employee/{id}/bonus', 'EmployeeController@editBonus')->name('employee.edit.bonus');

});
Route::namespace('Employee')->group(function () {
    Route::group(['middleware' => ['active']], function () {
        Route::get('/employee', 'EmployeeController@index')->name('employee.profile.index');
    });

    Route::group(['middleware' => ['employee']], function () {
        Route::get('/employee/{id}/contracts', 'ContractController@index')->name('employee.contracts');

        Route::get('/employee/{id}/payslips', 'PayslipController@index')->name('employee.payslips');
        Route::get('/employee/{id}/info', 'EmployeeController@editInfo')->name('employee.edit.info');
        Route::post('/employee/{id}/info', 'EmployeeController@updateInfo')->name('employee.update.info');
        Route::get('/employee/{id}/password', 'EmployeeController@editPassword')->name('employee.edit.password');
        Route::post('/employee/{id}/password', 'EmployeeController@updatePassword');
        Route::get('/employee/{id}/vacations', 'VacationController@index')->name('employee.vacations');
    });
    Route::get('/employee/{id}/contracts/download', 'ContractController@download')->name('contract.download');
    Route::get('/employee/{id}/contracts/view', 'ContractController@view')->name('contract.view');
    Route::get('/employee/vacations', 'VacationController@createVacation')->name('vacations.create');
    Route::post('/employee/vacations', 'VacationController@storeVacation')->name('vacations.store');




});



