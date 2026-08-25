<?php

use Illuminate\Support\Facades\Route;

Route::post('file-upload', 'FileController@uploadData')->name('file-upload');

Route::get('datos-export', 'Admin\AdminController@datosexport')->name('datos-export');

Route::post('file-import-change', 'FileController@datosimport')->name('file-import-change');

Route::post('file-import-trainings', 'FileController@datosimporttrainings')->name('file-import-trainings');

Route::post('file-import-trainings-participants', 'FileController@importPaticipantsTrainings')->name('file-import-trainings-participants');

