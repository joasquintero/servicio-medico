<?php

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
})->name('welcome');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/index', 'PagesController@index');
Route::get('/check', 'PagesController@dailyAttention');

// Grupo de rutas para Patient
Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::get('/permisos', 'PermissionController@index')->name('permissions.index');
    Route::get('/tracking', 'TrackingController@index')->name('tracking.index');
    
});

Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
Route::get('/doctors/workdays', 'DoctorController@indexDocWorkdays')->name('doctors.workdays');
Route::get('/operators', 'OperatorController@index')->name('operators.index');
Route::get('/patients', 'PatientController@index')->name('patients.index');
Route::get('/user-pending', 'UserController@indexRolPending')->name('user.pending');
Route::get('/illnesses', 'IllnessController@index')->name('illnesses.index');
Route::get('/consultations', 'ConsultationController@index')->name('consultations.index');
Route::get('/consultations/{doctor}/{patient}', 'ConsultationController@indexFromMeeting')->name('consultations.indexFromMeeting');
Route::get('/meetings', 'MeetingController@index')->name('meetings.index');
Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::get('/report/generate/{consultation_id}', 'ReportController@generateConsultationReport')->name('report.generate');

    /* Route::get('/pdf', function () {
        return view('reports.pdf.consultation');
    }); */