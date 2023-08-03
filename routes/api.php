<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryTypesController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LeaveTypesController;
use App\Http\Controllers\AllowedLeavesController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ShortLeaveController;
use App\Http\Controllers\SalaryAdvanceController;
use App\Http\Controllers\AttendancesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get ('/sa', [SalaryTypesController::class, 'index']);
Route::get ('/salaryTypes', [SalaryTypesController::class, 'getAllSalaryTypes']);
Route::get ('/salaryTypes/{id}', [SalaryTypesController::class, 'getSalaryTypeInfo']);
Route::POST('/salaryTypes', [SalaryTypesController::class, 'saveSalaryType']);
Route::put ('/salaryTypes/{id}', [SalaryTypesController::class, 'updateSalaryType']);
Route::delete ('/salaryTypes/{id}', [SalaryTypesController::class, 'destroySalaryType']);

Route::get ('/Positions', [PositionsController::class, 'getAllPositions']);
Route::get ('/Positions/{id}', [PositionsController::class, 'getPositionInfo']);
Route::POST('/Positions', [PositionsController::class, 'savePosition']);
Route::put ('/Positions/{id}', [PositionsController::class, 'updatePosition']);
Route::delete ('/Positions/{id}', [PositionsController::class, 'destroyPosition']);

Route::get ('/companies', [CompanyController::class, 'getAllCompanies']);
Route::get ('/companies/{id}', [CompanyController::class, 'getCompanyInfo']);
Route::POST('/companies', [CompanyController::class, 'saveCompany']);
Route::put ('/companies/{id}', [CompanyController::class, 'updateCompany']);
Route::delete ('/companies/{id}', [CompanyController::class, 'destroyCompany']);

Route::get('/qualifications',[QualificationsController::class, 'getAllQualification']);
Route::get('/qualifications/{id}',[QualificationsController::class, 'getQualificationInfo']);
Route::post('/qualifications',[QualificationsController::class, 'saveQualification']);
Route::put('/qualifications/{id}',[QualificationsController::class, 'updateQualification']);
Route::delete('/qualifications/{id}',[QualificationsController::class, 'destory']);


Route::get ('/departments', [DepartmentController::class, 'getAllDepartments']);
Route::get ('/departments/{id}', [DepartmentController::class, 'getDepartmentInfo']);
Route::POST('/departments', [DepartmentController::class, 'saveDepartment']);
Route::put ('/departments/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete ('/departments/{id}', [DepartmentController::class, 'destroyDepartment']);

Route::get ('/employees', [EmployeesController::class, 'getAllEmployees']);
Route::get ('/employees/{id}', [EmployeesController::class, 'getEmployeeInfo']);
Route::POST('/employees', [EmployeesController::class, 'saveEmployee']);
Route::put ('/employees/{id}', [EmployeesController::class, 'updateEmployee']);
Route::delete ('/employees/{id}', [EmployeesController::class, 'destroyEmployee']);

Route::get ('/announcement', [AnnouncementController::class, 'getAllAnnouncement']);
Route::get ('/announcement/{id}', [AnnouncementController::class, 'getAnnouncement']);
Route::POST('/announcement', [AnnouncementController::class, 'saveAnnouncement']);
Route::put ('/announcement/{id}', [AnnouncementController::class, 'updateAnnouncement']);
Route::delete ('/announcement/{id}', [AnnouncementController::class, 'destroyAnnouncement']);

Route::get ('/leavetypes', [LeaveTypesController::class, 'getAllLeaveTypes']);
Route::get ('/leavetypes/{id}', [LeaveTypesController::class, 'getLeaveTypesinfo']);
Route::POST('/leavetypes', [LeaveTypesController::class, 'saveLeaveTypes']);
Route::put ('/leavetypes/{id}', [LeaveTypesController::class, 'updateLeaveTypes']);
Route::delete ('/leavetypes/{id}', [LeaveTypesController::class, 'destroyLeaveTypes']);

Route::get ('/allowedleaves', [AllowedLeavesController::class, 'getAllAllowedLeaves']);
Route::get ('/allowedleaves/{id}', [AllowedLeavesController::class, 'getAllowedLeavesinfo']);
Route::POST('/allowedleaves', [AllowedLeavesController::class, 'saveAllowedLeaves']);
Route::put ('/allowedleaves/{id}', [AllowedLeavesController::class, 'updateAllowedLeaves']);
Route::delete ('/allowedleaves/{id}', [AllowedLeavesController::class, 'destroyAllowedLeaves']);

Route::get ('/Leaverequests', [LeaveRequestController::class, 'getAllLeave_requests']);
Route::get ('/Leaverequests/{id}', [LeaveRequestController::class, 'getAllLeave_requestInfo']);
Route::POST('/Leaverequests', [LeaveRequestController::class, 'saveLeave_requestInfo']);
Route::put ('/Leaverequests/{id}', [LeaveRequestController::class, 'updateLeave_requestInfo']);
Route::delete ('/Leaverequests/{id}', [LeaveRequestController::class, 'DistroyLeave_request']);

Route::get ('/shortLeaves', [ShortLeaveController::class, 'getAllShortLeave']);
Route::get ('/shortLeaves/{id}', [ShortLeaveController::class, 'getShortLeaveInfo']);
Route::POST('/shortLeaves', [ShortLeaveController::class, 'saveShortLeave']);
Route::put ('/shortLeaves/{id}', [ShortLeaveController::class, 'updateShortLeave']);
Route::delete ('/shortLeaves/{id}', [ShortLeaveController::class, 'destroyShortLeave']);

Route::get('/salaryadvance', [SalaryAdvanceController::class, 'getAllSalaryAdvances']);
Route::get('/salaryadvance/{id}', [SalaryAdvanceController::class, 'getSalaryAdavanceInfo']);
Route::post('/salaryadvance', [SalaryAdvanceController::class, 'saveSalaryAdvance']);
Route::put('/salaryadvance/{id}', [SalaryAdvanceController::class, 'updateSalaryAdvance']);
Route::delete('/salaryadvance/{id}', [SalaryAdvanceController::class, 'destroySalaryAdvance']);

Route::get('/attendance', [AttendancesController::class, 'getAllAttendance']);
Route::get('/attendance/{id}', [AttendancesController::class, 'getAttendanceinfo']);
Route::post('/attendance', [AttendancesController::class, 'saveAttendance']);
Route::put('/attendance/{id}', [AttendancesController::class, 'updateAttendance']);
Route::delete('/attendance/{id}', [AttendancesController::class, 'destroyAttendance']);
