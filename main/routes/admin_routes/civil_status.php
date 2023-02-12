<?php

/* * ******  CivilStatus Start ********** */
Route::get('list-civil-statuses', array_merge(['uses' => 'Admin\CivilStatusController@indexCivilStatuses'], $all_users))->name('list.civil.statuses');
Route::get('create-civil-status', array_merge(['uses' => 'Admin\CivilStatusController@createCivilStatus'], $all_users))->name('create.civil.status');
Route::post('store-civil-status', array_merge(['uses' => 'Admin\CivilStatusController@storeCivilStatus'], $all_users))->name('store.civil.status');
Route::get('edit-civil-status/{id}', array_merge(['uses' => 'Admin\CivilStatusController@editCivilStatus'], $all_users))->name('edit.civil.status');
Route::put('update-civil-status/{id}', array_merge(['uses' => 'Admin\CivilStatusController@updateCivilStatus'], $all_users))->name('update.civil.status');
Route::delete('delete-civil-status', array_merge(['uses' => 'Admin\CivilStatusController@deleteCivilStatus'], $all_users))->name('delete.civil.status');
Route::get('fetch-civil.statuses', array_merge(['uses' => 'Admin\CivilStatusController@fetchCivilStatusesData'], $all_users))->name('fetch.data.civil.statuses');
Route::put('make-active-civil-status', array_merge(['uses' => 'Admin\CivilStatusController@makeActiveCivilStatus'], $all_users))->name('make.active.civil.status');
Route::put('make-not-active-civil-status', array_merge(['uses' => 'Admin\CivilStatusController@makeNotActiveCivilStatus'], $all_users))->name('make.not.active.civil.status');
Route::get('sort-civil-statuses', array_merge(['uses' => 'Admin\CivilStatusController@sortCivilStatuses'], $all_users))->name('sort.civil.statuses');
Route::get('civil-status-sort-data', array_merge(['uses' => 'Admin\CivilStatusController@civilStatusSortData'], $all_users))->name('civil.status.sort.data');
Route::put('civil-status-sort-update', array_merge(['uses' => 'Admin\CivilStatusController@civilStatusSortUpdate'], $all_users))->name('civil.status.sort.update');
/* * ****** End CivilStatus ********** */