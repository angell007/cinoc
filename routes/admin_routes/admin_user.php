<?php

use Illuminate\Support\Facades\Route;
use App\Company;
use App\Job;
use App\Exports\Ids;

Route::get('gestion-permisos', 'Admin\GestionController@gestionar')->name('gestion-permisos');
Route::post('download/reports', 'ReportController@download')->name('download.reports');
Route::post('save-permissions', 'Admin\GestionController@store')->name('save-permissions');

// Not Sure
Route::get('/donwload-statictics-download', 'ExportController@download')->name('download');

Route::get('datos-export', 'Admin\AdminController@datosexport');
Route::get('reports', 'ReportController@showView')->name('reports');
Route::resource('documento_contratado', 'documento_contratadoController');

Route::get('send-cvs', function () {
    $companies = Company::get(['id', 'name']);
    return view('admin.send-cvs', compact('companies'));
});

Route::get('job-index/{id}', function ($id) {
    return response()->json(Job::where('company_id', $id)->get(['id', 'title']));
});

Route::get('job-users/{search}', 'Job\JobController@searchStudenByJobs');
Route::get('job-users-send-emails/{data}/{comapny}/{job}', 'Job\JobController@sendEmails');

Route::get('get-xls', function () {

    return (new Ids())->download('documentos.xlsx');
});

Route::resource('documento_pasantias', 'documento_pasantiasController');

Route::get('list/trainings', 'Admin\AdminController@viewlistTrainings')->name('list.trainings');
Route::get('list/participants/{id}', 'Admin\AdminController@viewlistParticipants')->name('list.participants');
Route::get('list/participants-companies/{id}', 'Admin\AdminController@viewlistParticipantsCompanies')->name('list.participants.companies');

Route::get('list/participants-all', 'Admin\AdminController@listParticipants')->name('get-list-participants');

Route::get('get-list-trainings', 'Admin\AdminController@listTrainingsUsers')->name('get-list-trainings');
Route::get('list/participants-delete', 'Admin\AdminController@listParticipantsDelete')->name('list.participants-delete');

Route::get('get-list-trainings-company', 'Admin\AdminController@listTrainingsComapnies')->name('get-list-trainings-company');
Route::post('delete-training-company', 'Admin\AdminController@deleteTrainingCompany')->name('delete-training-company');

Route::get('get-list-trainings-entrepreneurship', 'Admin\AdminController@listTrainingsEntrepreneurship')->name('get-list-trainings-entrepreneurship');
Route::get('list/participants-entrepreneurship/{id}', 'Admin\AdminController@viewlistParticipantsEntrepreneurship')->name('list.participants.entrepreneurship');
Route::post('delete-training-entrepreneurship', 'Admin\AdminController@deleteTrainingEntrepreneurship')->name('delete-training-entrepreneurship');

Route::get('register_companies_training', 'Admin\AdminController@viewlistCompanies')->name('register_companies_training');
Route::get('register_users_training', 'Admin\AdminController@viewlistUsers')->name('register_users_training');
Route::get('register_entrepreneurship_training', 'Admin\AdminController@viewlistEntrepreneurship')->name('register_entrepreneurship_training');

// Imports cvs
Route::post('file-import-cvs', 'Admin\AdminController@importsendedcvs')->name('file-import-cvs');
Route::get('get-cvs-sended', 'Admin\AdminController@getsendedcvs')->name('get-cvs-sended');
Route::get('sendedcv-delete', 'Admin\AdminController@deletesendedcvs')->name('sendedcv-delete');


/* * ******  Admin User Start ********** */

Route::get('list-admin-users', array_merge(['uses' => 'Admin\AdminController@indexAdminUsers'], $sup_only))->name('list.admin.users');

Route::get('create-admin-user', array_merge(['uses' => 'Admin\AdminController@createAdminUser'], $sup_only))->name('create.admin.user');

Route::post('store-admin-user', array_merge(['uses' => 'Admin\AdminController@storeAdminUser'], $sup_only))->name('store.admin.user');

Route::get('edit-admin-user/{id}', array_merge(['uses' => 'Admin\AdminController@editAdminUser'], $sup_only))->name('edit.admin.user');

Route::put('update-admin-user/{id}', array_merge(['uses' => 'Admin\AdminController@updateAdminUser'], $sup_only))->name('update.admin.user');

Route::delete('delete-admin-user', array_merge(['uses' => 'Admin\AdminController@deleteAdminUser'], $sup_only))->name('delete.admin.user');

Route::delete('delete-admin-document', array_merge(['uses' => 'Admin\AdminController@deleteAdminDocument'], $sup_only))->name('delete.document');

Route::get('fetch-admin-users', array_merge(['uses' => 'Admin\AdminController@fetchAdminUsersData'], $sup_only))->name('fetch.data.admin.users');


Route::resource('template_contrato', 'template_contratoController');

/* * ****** End Admin User ********** */
