<?php



namespace App\Exports;



use App\Job;

use App\JobApply;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

use Carbon\Carbon;



class VacancyApplyExport implements FromView

{

    public function view(): View

    {
        $today = Carbon::now();

        if (request()->get('inicio')) {

            $OfertaLaboral = JobApply::whereBetween('job_apply.created_at', [Carbon::parse(request()->get('inicio'))->startOfDay(), Carbon::parse(request()->get('fin'))->endOfDay()])

                ->join('users', 'users.id', 'job_apply.user_id')
                ->join('jobs', 'jobs.id', 'job_apply.job_id')
                ->join('companies', 'companies.id', 'jobs.company_id')
                ->leftjoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')

                ->get([

                    'companies.name as company',

                    'jobs.title',

                    'users.name as candidato',

                    'users.national_id_card_number as identificacion',

                    'functional_areas.functional_area as programa',

                    'users.rol',

                    'users.mobile_num',

                    'users.email',

                ]);



            return view('export.vacancy', [

                'vacancys' => $OfertaLaboral

            ]);
        }







        $OfertaLaboral = JobApply::whereMonth('job_apply.created_at', '=', $today->month)

            ->join('users', 'users.id', 'job_apply.user_id')
            ->join('jobs', 'jobs.id', 'job_apply.job_id')
            ->join('companies', 'companies.id', 'jobs.company_id')
            ->leftjoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
            ->get([

                'companies.name as company',

                'jobs.title',

                'users.name as candidato',

                'users.national_id_card_number as identificacion',

                'functional_areas.functional_area as programa',

                'users.rol',

                'users.email',

                'users.mobile_num',

            ]);



        return view('export.vacancy', [

            'vacancys' => $OfertaLaboral

        ]);
    }
}
