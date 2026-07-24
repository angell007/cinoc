<?php

use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('file-upload', 'FileController@uploadData')->name('file-upload');

Route::get('datos-export', 'Admin\AdminController@datosexport')->name('datos-export');

Route::post('file-import-change', 'FileController@datosimport')->name('file-import-change');

Route::post('file-import-trainings', 'FileController@datosimporttrainings')->name('file-import-trainings');

Route::post('file-import-trainings-participants', 'FileController@importPaticipantsTrainings')->name('file-import-trainings-participants');

Route::get('createpdf', function () {
    $userId = Auth::id();
    if (!$userId) {
        return redirect()->route('login');
    }

    $user = User::with([
        'profileEducation',
        'profileExperience',
        'profileSkills',
        'profileLanguages',
    ])->find($userId);

    if (!$user) {
        abort(404);
    }

    try {
        $pdf = PDF::loadView('ejemplo', compact('user'))->setPaper('letter');
        $safeName = preg_replace('/[^a-z0-9]+/i', '-', strtolower($user->getName() ?: 'candidato'));

        return $pdf->download('hoja-de-vida-' . trim($safeName, '-') . '.pdf');
    } catch (\Throwable $e) {
        report($e);

        return redirect()
            ->back()
            ->with('error', 'No fue posible generar la hoja de vida en PDF. Intenta nuevamente.');
    }
})->name('download.my.cv')->middleware('auth');
