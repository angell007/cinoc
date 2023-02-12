<?php

namespace App\Exports;

use App\Job;
use App\JobApply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class Interview implements FromView
{
    public function view(): View
    {
         if(request()->get('inicio')){
         $interviews=JobApply::whereBetween('job_apply.updated_at', [request()->get('inicio'), request()->get('fin')])
             ->where('job_apply.status', 'entrevista')
              ->join('users', 'users.id', 'job_apply.user_id')->join('jobs', 'jobs.id', 'job_apply.job_id')->join('companies', 'companies.id', 'jobs.company_id')->get([
             'companies.name as company',
             'jobs.title',
             'users.name as candidato',
             'users.rol',
             'users.mobile_num',
             'users.email',
             ]);
         
         return view('export.vacancy', [
            'vacancys' => $interviews
        ]);
        
        }
    }
}