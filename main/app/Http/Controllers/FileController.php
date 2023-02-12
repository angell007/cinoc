<?php

namespace App\Http\Controllers;

use App\Imports\IdcardsNumbersExcel;
use App\Imports\Trainings;
use App\Imports\IdcardsNumbersChangeExcel;
use Illuminate\Http\Request;

use DB;

use App\Http\Requests\UploadIdCards;

use Illuminate\Support\Facades\Session;

use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function uploadData()
    {
        try {
            Excel::import(new IdcardsNumbersExcel, request()->file('file')->store('temp'));
            Session::flash('message', 'Documentos subidos correctamente!!'); 
            Session::flash('alert-class', 'alert-success');
            return back();
        } catch (\Throwable $th) {
            // return $th->getMessage();
            Session::flash('message', 'No hemos podido subir los documentos por que el archivo no es correcto!!'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
    
    public function datosimport()
    {
        try {
            Excel::import(new IdcardsNumbersChangeExcel, request()->file('file')->store('temp'));
            Session::flash('message', 'Documentos subidos correctamente!!'); 
            Session::flash('alert-class', 'alert-success');
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
            Session::flash('message', 'No hemos podido subir los documentos por que el archivo no es correcto!!'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
    
    public function datosimporttrainings()
    {
        try {
               $id = DB::table('trainings')->insertGetId([
                    
                        'name' => request()->get('name'), 
                        'type' => request()->get('type')
                    
                ]);
            
            Excel::import(new Trainings($id), request()->file('file')->store('temp'));
            Session::flash('message', 'Documentos subidos correctamente!!'); 
            Session::flash('alert-class', 'alert-success');
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage() . $th->getLine() . $th->getFile() ;
            Session::flash('message', 'No hemos podido subir los documentos por que el archivo no es correcto!!'); 
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
}
