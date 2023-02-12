<?php



namespace App\Http\Controllers;



use Maatwebsite\Excel\Facades\Excel;

use App\User;

use App\Company;

use App\Job;

use App\Exports\InvoicesExport;

use App\Exports\CompanysExport;

use App\Exports\JobsExport;

use App\Exports\VacancyContractExport;

use App\Exports\VacancyApplyExport;

use App\Exports\Interview;

use App\Exports\Remitidos;
use App\Traits\ReportsTxt;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ReportsTxt;

    public function showView()
    {
        return view('reports.reports');
    }

    public function htmlToPlainText($str)
    {

        $str = str_replace('&nbsp;', ' ', $str);

        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT, 'UTF-8');

        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');

        $str = html_entity_decode($str);

        $str = htmlspecialchars_decode($str);

        $str = strip_tags($str);

        $str = preg_replace("/[\r\n|\n|\r]+/", ' ',  $str);



        $str = str_replace(

            array('���', '���', '���', '���', '���', '���', '���', '���', '���'),

            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),

            $str

        );



        $str = str_replace(

            array('���', '���', '���', '���', '���', '���', '���', '���'),

            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),

            $str

        );



        $str = str_replace(

            array('���', '���', '���', '���', '���', '���', '���', '���'),

            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),

            $str

        );



        $str = str_replace(

            array('���', '���', '���', '���', '���', '���', '���', '���'),

            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),

            $str

        );



        $str = str_replace(

            array('���', '���', '���', '���', '���', '���', '���', '���'),

            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),

            $str

        );



        $str = str_replace(

            array('���', '���', '���', '���'),

            array('n', 'N', 'c', 'C',),

            $str

        );



        $str = str_replace(

            array('$'),

            array(' '),

            $str

        );



        $str = trim($str);



        return $str;
    }

    public function getSalary($salary_from, $salary_to)
    {

        $pattern = "/[^0-9]/";
        $patternOnlyZeros = "/^0+$/";

        if (preg_match($patternOnlyZeros, preg_replace($pattern, "", $salary_to)) || preg_match($patternOnlyZeros,  $salary_to)) {
            return preg_replace($pattern, "", $salary_from);
        } else {
            return preg_replace($pattern, "", $salary_from) . '-' . preg_replace($pattern, "", $salary_to);
        }
    }
    public function replaceyears($years)
    {



        $years = str_replace(

            array('a', 'n', 'o', 's', 'ñ'),

            array('', '', '', '', ''),

            $years

        );



        return (int)$years * 12;
    }

    public function download()

    {

        $data = [];

        switch (request()->get('tipo_reporte')) {

            case 1:
                $data = $this->getStudents();

                return Excel::download(new InvoicesExport($data), 'Estudiantes' . '.xlsx');
            case 2:
                $data = $this->getCompanys();

                return Excel::download(new CompanysExport($data), 'Compañias' . '.xlsx');
            case 3:
                $data = $this->getJobs();

                return Excel::download(new JobsExport($data), 'Empleos' . '.xlsx');
            case 4:
                $data = $this->getEgresados();

                return Excel::download(new InvoicesExport($data), 'Egresados' . '.xlsx');
            case 5:
                return Excel::download(new VacancyContractExport(), 'contratados.xlsx');
            case 6:
                return Excel::download(new VacancyApplyExport(), 'vacantes_aplicadas.xlsx');
            case 7:
                return Excel::download(new Interview(), 'Entrevistados.xlsx');
            case 8:
                return Excel::download(new Remitidos(), 'Remitidos.xlsx');
            case 9:
                return $this->PositionsTxt();
            case 10:
                return $this->OferentesMensualTxt();
            case 11:
                return $this->OferentesSemestralTxt();
            case 12:
                return $this->PracticasLaboralesTxt();
        }
    }

    public function getStudents()
    {



        return  User::leftJoin('countries', 'countries.id', 'users.country_id')

            ->leftJoin('cities', 'cities.id', 'users.city_id')

            ->leftJoin('states', 'states.id', 'users.state_id')

            ->leftJoin('industries', 'industries.id', 'users.industry_id')

            ->leftJoin('career_levels', 'career_levels.id', 'users.career_level_id')

            ->leftJoin('profile_skills', 'profile_skills.user_id', 'users.id')

            ->leftJoin('job_skills', 'job_skills.id', 'profile_skills.job_skill_id')

            ->leftJoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')

            ->where('rol', 'Estudiante')



            ->select(

                [

                    'users.id',

                    'users.first_name',

                    'users.middle_name',

                    'users.first_lastname',

                    'users.second_lastname',

                    'users.email',

                    'users.national_id_card_number',

                    'users.password',

                    DB::raw("REPLACE(users.mobile_num, ' ', '' ) As 'phone'"),

                    'users.country_id',

                    'users.state_id',

                    'users.city_id',

                    'users.industry_id',

                    'users.rol',

                    'users.is_immediate_available',

                    'users.num_profile_views',

                    'users.is_active',

                    'users.verified',

                    'users.created_at',

                    'users.updated_at',

                    'cities.city',

                    'states.state',

                    'industries.industry',

                    'career_levels.career_level',

                    DB::raw("CONCAT_WS('|', `job_skills`.`job_skill`) As 'skill'"),

                    'functional_areas.functional_area',

                ]

            )->when(request()->get('inicio') && request()->get('fin'), function ($q) {

                $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->groupBy('users.id')

            ->get();
    }



    public function getEgresados()
    {



        return  User::leftJoin('countries', 'countries.id', 'users.country_id')

            ->leftJoin('cities', 'cities.id', 'users.city_id')

            ->leftJoin('states', 'states.id', 'users.state_id')

            ->leftJoin('industries', 'industries.id', 'users.industry_id')

            ->leftJoin('career_levels', 'career_levels.id', 'users.career_level_id')

            ->leftJoin('profile_skills', 'profile_skills.user_id', 'users.id')

            ->leftJoin('job_skills', 'job_skills.id', 'profile_skills.job_skill_id')

            ->leftJoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')

            ->where('rol', 'Egresado')

            ->select(

                [

                    'users.id',

                    'users.first_name',

                    'users.middle_name',

                    'users.second_lastname',

                    'users.first_lastname',

                    'users.email',

                    'users.national_id_card_number',

                    'users.password',

                    DB::raw("REPLACE(users.mobile_num, ' ', '' ) As 'phone'"),

                    'users.country_id',

                    'users.state_id',

                    'users.city_id',

                    'users.industry_id',

                    'users.rol',

                    'users.is_immediate_available',

                    'users.num_profile_views',

                    'users.is_active',

                    'users.verified',

                    'users.created_at',

                    'users.updated_at',

                    'cities.city',

                    'states.state',

                    'industries.industry',

                    'career_levels.career_level',

                    // 'job_skills.job_skill',

                    DB::raw("GROUP_CONCAT('--', `job_skills`.`job_skill`) As 'skill'"),

                    'functional_areas.functional_area',

                ]

            )->when(request()->get('inicio') && request()->get('fin'), function ($q) {

                $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->groupBy('users.id')

            ->get();
    }



    public function getCompanys()
    {





        return  Company::join('cities', 'cities.id', 'companies.city_id')

            ->join('states', 'states.id', 'companies.state_id')

            ->join('industries', 'industries.id', 'companies.industry_id')

            ->select([

                'companies.id',

                'companies.name',

                'companies.email',

                'companies.password',

                'companies.ceo',

                'companies.industry_id',

                'companies.ownership_type_id',

                'companies.description',

                'companies.location',

                'companies.no_of_offices',

                'companies.website',

                'companies.no_of_employees',

                'companies.established_in',

                'companies.fax',

                'companies.phone',

                'companies.logo',

                'companies.country_id',

                'companies.state_id',

                'companies.city_id',

                'companies.is_active',

                'companies.is_featured',

                'companies.camara_comercio',

                'cities.city',

                'states.state',

                'industries.industry',

            ])

            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {

                $q->whereBetween('companies.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();
    }



    public function getJobs()
    {





        return Job::join('companies', 'companies.id', 'jobs.company_id')

            // $data = Job::join('companies', 'companies.id', 'jobs.company_id')

            ->join('job_experiences', 'job_experiences.job_experience_id', 'jobs.job_experience_id')

            ->join('functional_areas', 'functional_areas.functional_area_id', 'jobs.functional_area_id')

            ->join('degree_levels', 'degree_levels.degree_level_id', 'jobs.degree_level_id')

            ->join('industries', 'industries.industry_id', 'companies.industry_id')

            ->join('job_types', 'job_types.job_type_id', 'jobs.job_type_id')

            ->select([

                'jobs.company_id',

                'jobs.id',

                'jobs.title',

                'jobs.description',

                'job_experiences.job_experience',

                'functional_areas.functional_area',

                'degree_levels.degree_level',

                'jobs.salary_currency',

                'jobs.num_of_positions',

                'jobs.position',

                'companies.tipo_identificacion',

                'companies.identificacion',

                'companies.name',

                'jobs.show_info',

                'jobs.created_at',

                'jobs.expiry_date',

                'jobs.city_id',

                'industries.industry',

                'job_types.job_type',

                'jobs.is_freelance',

                'jobs.is_freelance',

                'jobs.slug',

            ])

            ->where('job_experiences.is_default', 1)

            ->where('job_types.is_default', 1)

            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {

                $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();



        // dd($data);

    }
}
