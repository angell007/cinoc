<?php

namespace App\Exports;

use App\Job;
use App\JobApply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use DB;

class Remitidos implements FromView
{
    public function view(): View
    {





        if (request()->get('inicio')) {



            try {



                $interviews = DB::table('sended_cvs')

                    ->join('users', 'users.national_id_card_number', 'sended_cvs.id_number')

                    // ->join('jobs', 'jobs.id', 'send_emails.job_id')

                    // ->join('companies', 'companies.id', 'send_emails.company_id')

                    ->leftJoin('genders', 'genders.id', 'users.gender_id')

                    ->leftJoin('marital_statuses', 'marital_statuses.id', 'users.marital_status_id')

                    ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') BETWEEN ? AND ?", [
                        date('Y-m-d', strtotime(request()->get('inicio'))),
                        date('Y-m-d', strtotime(request()->get('fin')))
                    ])

                    // ->whereBetween('send_emails.send_date', [request()->get('inicio'), request()->get('fin')])

                    ->get([

                        'sended_cvs.company as company',

                        'sended_cvs.position as description',

                        'sended_cvs.programa as programa',

                        'sended_cvs.position as title',

                        'users.name as candidato',

                        'users.rol',

                        'users.mobile_num',

                        'users.email',

                        'sended_cvs.id_number  as identificacion',

                        'sended_cvs.date',

                        'genders.gender',

                        'marital_statuses.marital_status'

                    ]);
            } catch (\Exception $th) {
                dd($th->getMessage());
            }



            return view('export.vacancy', [

                'vacancys' => $interviews

            ]);
        }
    }
}
