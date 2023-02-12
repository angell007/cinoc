<?php

use Illuminate\Support\Facades\Route;
use App\User;

Route::post('file-upload', 'FileController@uploadData')->name('file-upload');
Route::get('datos-export', 'Admin\AdminController@datosexport')->name('datos-export');
Route::post('file-import-change', 'FileController@datosimport')->name('file-import-change');
Route::post('file-import-trainings', 'FileController@datosimporttrainings')->name('file-import-trainings');
Route::get('createpdf', function(){
    
    
     $user = User::with('jobExperience', 'profileEducation', 'profileExperience', 'profileSkills')->find(Auth::user()->id);
     
    //  dd($user);
     
     $pdf = \PDF::loadView('ejemplo', compact('user'));
     return $pdf->download($user->name . '.PDF');
    
    
})->name('download.my.cv');
