<?php

namespace App\Exports;

use App\User;
use App\Company;
use App\Job;
use App\JobApply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
use DB;

class DatosExport implements FromView
{
    private $a;
    private $b;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function view(): View
    {
        try {

            $today = Carbon::parse($this->a);

            $company_registered = Company::whereMonth('created_at', '=', $today->month)->count();
            
            $genders = DB::table('genders')->select('*')->where('lang', 'es')->get();
            $poblacions = DB::table('marital_statuses')->select('*')->where('lang', 'es')->get();
            
            $legens = [
                 'Registrados', 'Registrados de población',
                 'Número de Hojas de Vida Remitidas', 'Número de Hojas de Vida Remitidas de población ',
                 'Número de Personas Colocadas ', 'Número de Personas colocadas con enfoque diferencial '
                ];
            $results = [];
            
            $results[$legens[0] . ' ' . 'No data' ] = User::whereNull("gender_id")->where('created_at', '>=', $this->a)->where('created_at', '<=', $this->b)->get();
            
            foreach($genders as $gender){
                     $results[$legens[0] . ' ' . $gender->gender ] = User::where("gender_id",  $gender->gender_id)->where('created_at', '>=', $this->a)->where('created_at', '<=', $this->b)->get();
            }
            
            foreach($genders as $gender){
                 foreach($poblacions as $poblacion){
                      $results[$legens[1] . ' ' .$gender->gender. ' ' . $poblacion->marital_status ] = User::where("gender_id", $gender->gender_id)->where('marital_status_id', $poblacion->marital_status_id)->where('created_at', '>=', $this->a)->where('created_at', '<=', $this->b)->get();
                
                 }
                 
                 $results[$legens[1] . ' ' .$gender->gender. ' No data'] = User::where("gender_id", $gender->gender_id)->whereNull('marital_status_id')->where('created_at', '>=', $this->a)->where('created_at', '<=', $this->b)->get();

            }
            
            
            foreach($genders as $gender){
                      $results[$legens[2] . ' ' .$gender->gender ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("users.gender_id", $gender->gender_id)->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'espera')->get();
            }
            
            
            foreach($genders as $gender){
                 foreach($poblacions as $poblacion){
                      $results[$legens[3] . ' ' .$gender->gender. ' ' . $poblacion->marital_status ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("users.gender_id", $gender->gender_id)->where('users.marital_status_id', $poblacion->marital_status_id)->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'espera')->get();
                
                 }
                      $results[$legens[3] . ' ' .$gender->gender. ' No data ' ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("users.gender_id", $gender->gender_id)->whereNull('users.marital_status_id')->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'espera')->get();
            }
            
            
             foreach($genders as $gender){
                      $results[$legens[4] . ' ' .$gender->gender ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("job_apply.status", "=", "contratado")->where("users.gender_id", $gender->gender_id)->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'contratado')->get();
            }
            
            foreach($genders as $gender){
                 foreach($poblacions as $poblacion){
                      $results[$legens[5] . ' ' .$gender->gender. ' ' . $poblacion->marital_status ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("job_apply.status", "=", "contratado")->where("users.gender_id", $gender->gender_id)->where('users.marital_status_id', $poblacion->marital_status_id)->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'contratado')->get();
                
                 }
                      $results[$legens[5] . ' ' .$gender->gender. ' No data ' ] = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("job_apply.status", "=", "contratado")->where("users.gender_id", $gender->gender_id)->whereNull('users.marital_status_id')->where('job_apply.updated_at', '>=', $this->a)->where('job_apply.updated_at', '<=', $this->b)->where('status', 'contratado')->get();
            }
          
            return view(
                'export.datos',
                 compact('results','company_registered')
            );
        } catch (\Throwable $th) {
            return view('admin.home');
            // return back();
            // dd([$th->getMessage(), $th->getLine()]);
        }
    }
}
