<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Roles routes
Route::post('/role/create', 'RoleController@store')->name('role.store');
Route::post('/role/update', 'RoleController@update')->name('role.update');
Route::post('/role/delete', 'RoleController@destroy')->name('role.delete');
Route::post('/role/info', 'RoleController@getRecordFullInfo')->name('role.info');

// Permissions routes
Route::post('/permission/create', 'PermissionController@store')->name('permission.store');
Route::post('/permission/update', 'PermissionController@update')->name('permission.update');
Route::post('/permission/delete', 'PermissionController@destroy')->name('permission.delete');
Route::post('/permission/info', 'PermissionController@getRecordFullInfo')->name('permission.info');

// Users routes
Route::post('/user/create', 'UserController@store')->name('user.store');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/delete', 'UserController@destroy')->name('user.delete');
Route::post('/user/info', 'UserController@getRecordFullInfo')->name('user.info');
Route::post('/user/name', function (Request $request){
    return getUserName($request->field);
})->name('user.name');
Route::post('/user/rol', 'UserController@setUserRol')->name('user.rol');

// Doctors routes
Route::post('/doctor/create', 'DoctorController@store')->name('doctor.store');
Route::post('/doctor/update', 'DoctorController@update')->name('doctor.update');
Route::post('/doctor/delete', 'DoctorController@destroy')->name('doctor.delete');
Route::post('/doctor/info', 'DoctorController@getRecordFullInfo')->name('doctor.info');
Route::post('/doctor/time', function (Request $request){
    return checkDocTime($request->doctor_name, $request->time);
})->name('doctor.time');
Route::post('/doctor/workdays', function (Request $request){
    return checkDocWorkdays($request->doctor_name, $request->day);
})->name('doctor.workdays');

// Operators routes
Route::post('/operator/create', 'OperatorController@store')->name('operator.store');
Route::post('/operator/update', 'OperatorController@update')->name('operator.update');
Route::post('/operator/delete', 'OperatorController@destroy')->name('operator.delete');
Route::post('/operator/info', 'OperatorController@getRecordFullInfo')->name('operator.info');

// Patients routes
Route::post('/patient/create', 'PatientController@store')->name('patient.store');
Route::post('/patient/update', 'PatientController@update')->name('patient.update');
Route::post('/patient/delete', 'PatientController@destroy')->name('patient.delete');
Route::post('/patient/info', 'PatientController@getRecordFullInfo')->name('patient.info');
Route::post('/patient/name', function (Request $request){
    return getPatientName($request->field);
})->name('patient.name');

// Illnesses routes
Route::post('/illness/create', 'IllnessController@store')->name('illness.store');
Route::post('/illness/update', 'IllnessController@update')->name('illness.update');
Route::post('/illness/delete', 'IllnessController@destroy')->name('illness.delete');
Route::post('/illness/info', 'IllnessController@getRecordFullInfo')->name('illness.info');
Route::post('/illness/id', function (Request $request){
    return getIllnessId($request->field);
})->name('illness.id');
Route::post('/illness/name', function (Request $request){
    return getIllnessName($request->field);
})->name('illness.name');

// Consultation routes
Route::post('/consultation/create', 'ConsultationController@store')->name('consultation.store');
Route::post('/consultation/update', 'ConsultationController@update')->name('consultation.update');
Route::post('/consultation/delete', 'ConsultationController@destroy')->name('consultation.delete');
Route::post('/consultation/info', 'ConsultationController@getRecordFullInfo')->name('consultation.info');

// Meeting routes
Route::post('/meeting/create', 'MeetingController@store')->name('meeting.store');
Route::post('/meeting/update', 'MeetingController@update')->name('meeting.update');
Route::post('/meeting/delete', 'MeetingController@destroy')->name('meeting.delete');
Route::post('/meeting/info', 'MeetingController@getRecordFullInfo')->name('meeting.info');

// Tracking routes
Route::post('/tracking/create', 'TrackingController@store')->name('tracking.store');
Route::post('/tracking/delete', 'TrackingController@destroy')->name('tracking.delete');

