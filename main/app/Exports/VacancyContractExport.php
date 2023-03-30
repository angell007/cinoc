<?php



namespace App\Exports;



use App\Job;

use App\JobApply;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

use Carbon\Carbon;

use DB;



class VacancyContractExport implements FromView

{

    public function view(): View

    {



        $today = Carbon::now();

        if (request()->get('inicio')) {

            $OfertaLaboral = JobApply::where("status", "=", "contratado")

                ->whereBetween('job_apply.created_at', [request()->get('inicio'), request()->get('fin')])

                ->join('users', 'users.id', 'job_apply.user_id')

                ->join('jobs', 'jobs.id', 'job_apply.job_id')

                ->join('companies', 'companies.id', 'jobs.company_id')

                ->select(

                    'companies.name',

                    'jobs.title',

                    'users.email',

                    'users.name as estudent',

                    'users.rol'

                )

                ->get();



            return view('export.vacancycontracts', [

                'vacancys' => $OfertaLaboral

            ]);
        }



        $OfertaLaboral = JobApply::where("status", "=", "contratado")

            ->whereMonth('job_apply.created_at', '=', $today->month)

            ->join('users', 'users.id', 'job_apply.user_id')

            ->join('jobs', 'jobs.id', 'job_apply.job_id')

            ->join('companies', 'companies.id', 'jobs.company_id')

            ->select(

                'companies.name',

                'jobs.title',

                'users.email',

                'users.name as estudent',

                'users.rol'

            )

            ->get();



        return view('export.vacancycontracts', [

            'vacancys' => $OfertaLaboral

        ]);
    }
}
