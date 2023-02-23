<?php

namespace App\Traits;

use App\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ReportsTxt
{

    protected $codeIes = 22235;
    protected $separatorSingle = '|$|';
    protected $separatorDouble = '|$$|';
    protected $yes = 'S';
    protected $not = 'N';
    protected $urlBase = 'https://bolsaempleo.iescinoc.edu.co/';
    protected $baseSalary = 1160000;

    public function PositionsTxt()
    {
        $data = Job::join(
            'companies',
            'companies.id',
            'jobs.company_id'
        )->join(
            'job_experiences',
            'job_experiences.job_experience_id',
            'jobs.job_experience_id'
        )->join(
            'functional_areas',
            'functional_areas.functional_area_id',
            'jobs.functional_area_id'
        )->join(
            'degree_levels',
            'degree_levels.degree_level_id',
            'jobs.degree_level_id'
        )->join(
            'industries',
            'industries.industry_id',
            'companies.industry_id'
        )->join(
            'job_types',
            'job_types.job_type_id',
            'jobs.job_type_id'
        )->join(
            'cities',
            'cities.city_id',
            'jobs.city_id'
        )->select([
            'jobs.company_id',
            'jobs.id',
            'jobs.title',
            'jobs.description',
            'job_experiences.experience_for_report',
            'functional_areas.functional_area',
            'degree_levels.qualification_2019',
            'jobs.salary_currency',
            'jobs.num_of_positions',
            'jobs.position',
            'companies.tipo_identificacion',
            'companies.identificacion',
            'companies.name',
            'jobs.show_info',
            'jobs.created_at',
            'jobs.expiry_date',
            'jobs.salary_from',
            'jobs.salary_to',
            'cities.code',
            'industries.industry',
            'job_types.type_for_report',
            'jobs.is_freelance',
            'jobs.pcd',
            'jobs.to_publish',
            'jobs.slug',
            'jobs.id',
        ])
            ->where('job_experiences.is_default', 1)
            ->where('jobs.is_pl', 0)
            ->where('job_types.is_default', 1)
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
            })->get();

        $file = $this->codeIes . Carbon::now()->format('Ymd') . ".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {

            fwrite($txt, $this->codeIes . $this->separatorDouble);
            fwrite($txt, $datum->id . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->title) . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->description) . $this->separatorDouble);
            fwrite($txt, $datum->experience_for_report . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->qualification_2019) . $this->separatorDouble);

            if (in_array($datum->qualification_2019, [5, 6, 7, 8, 9, 11])) {
                fwrite($txt, $this->htmlToPlainText($datum->functional_area) . $this->separatorDouble);
            } else {
                fwrite($txt, $this->htmlToPlainText('NA') . $this->separatorDouble);
            }

            fwrite($txt, $this->getSalary($datum->salary_from, $datum->salary_to) . $this->separatorDouble);
            fwrite($txt, $datum->num_of_positions . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->position) . $this->separatorDouble);
            fwrite($txt, 1 . $this->separatorDouble);
            fwrite($txt, $datum->identificacion . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->name) . $this->separatorDouble);

            // if (strlen($datum->to_publish) == 1) {
            //     fwrite($txt, $this->yes . $this->separatorDouble);
            // } else {
                fwrite($txt, $this->not . $this->separatorDouble);
            // }
            fwrite($txt, Carbon::parse($datum->created_at)->format('d/m/Y') . $this->separatorDouble);
            fwrite($txt, Carbon::parse($datum->expiry_date)->format('d/m/Y') . $this->separatorDouble);

            if (strlen($datum->code) == 5) {
                fwrite($txt, $this->htmlToPlainText($datum->code) . $this->separatorDouble);
            } else {
                fwrite($txt,  $this->htmlToPlainText(0 . $datum->code) . $this->separatorDouble);
            }
            fwrite($txt, $this->htmlToPlainText($datum->industry) . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->type_for_report) . $this->separatorDouble);
            if ($datum->is_freelance) {
                fwrite($txt, $this->htmlToPlainText(1 . $this->separatorDouble));
            } else {
                fwrite($txt,  $this->htmlToPlainText(0 . $this->separatorDouble));
            }
            fwrite($txt, $this->separatorDouble  . $datum->pcd . $this->separatorDouble);
            fwrite($txt, $this->urlBase . 'job/' . $datum->slug);
            fwrite($txt,  PHP_EOL);
            fwrite($txt,  "\r\n");
        }
        fclose($txt);
        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain',
        ]);
    }
    public function PracticasLaboralesTxt()
    {
        $data = Job::join(
            'companies',
            'companies.id',
            'jobs.company_id'
        )->join(
            'job_experiences',
            'job_experiences.job_experience_id',
            'jobs.job_experience_id'
        )->join(
            'functional_areas',
            'functional_areas.functional_area_id',
            'jobs.functional_area_id'
        )->join(
            'degree_levels',
            'degree_levels.degree_level_id',
            'jobs.degree_level_id'
        )->join(
            'industries',
            'industries.industry_id',
            'companies.industry_id'
        )->join(
            'job_types',
            'job_types.job_type_id',
            'jobs.job_type_id'
        )->join(
            'cities',
            'cities.city_id',
            'jobs.city_id'
        )->select([
            'jobs.company_id',
            'jobs.id',
            'jobs.title',
            'jobs.description',
            'job_experiences.job_experience',
            'functional_areas.functional_area',
            'degree_levels.qualification_319',
            'jobs.salary_currency',
            'jobs.num_of_positions',
            'jobs.position',
            'companies.tipo_identificacion',
            'companies.identificacion',
            'companies.name',
            'jobs.show_info',
            'jobs.created_at',
            'jobs.expiry_date',
            'jobs.salary_from',
            'jobs.salary_to',
            'cities.code',
            'industries.industry',
            'job_types.type_for_report',
            'jobs.is_freelance',
            'jobs.is_freelance',
            'jobs.slug',
            'jobs.id',
        ])->where('job_experiences.is_default', 1)
            ->where('job_types.is_default', 1)
            ->where('jobs.is_pl', 1)
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
            })->get();

        $file =  'PL' . $this->codeIes . Carbon::now()->format('Ymd') .  ".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {
            fwrite($txt, $this->codeIes . $this->separatorDouble);
            fwrite($txt, $datum->id . $this->separatorDouble);
            fwrite($txt, 'PL-' . $this->htmlToPlainText($datum->title) . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->description) . $this->separatorDouble);
            fwrite($txt, 0 . $this->separatorDouble);

            fwrite($txt, $this->htmlToPlainText($datum->qualification_319) . $this->separatorDouble);

            fwrite($txt, $this->htmlToPlainText($datum->functional_area) . $this->separatorDouble);

            fwrite($txt, $this->getSalary($datum->salary_from, $datum->salary_to) . $this->separatorDouble);
            fwrite($txt, $datum->num_of_positions . $this->separatorDouble);
            $profess =  DB::table('professions')->where('name', $datum->position)->first();
            fwrite($txt, $this->htmlToPlainText('000' . substr($profess->id, 0, 1)) . $this->separatorDouble);
            fwrite($txt, 1 . $this->separatorDouble);
            fwrite($txt, $datum->identificacion . $this->separatorDouble);
            fwrite($txt, $this->htmlToPlainText($datum->name) . $this->separatorDouble);

            fwrite($txt, $this->not . $this->separatorDouble);

            fwrite($txt, Carbon::parse($datum->created_at)->format('d/m/Y') . $this->separatorDouble);
            fwrite($txt, Carbon::parse($datum->expiry_date)->format('d/m/Y') . $this->separatorDouble);

            if (strlen($datum->code) == 5) {
                fwrite($txt, $this->htmlToPlainText($datum->code) . $this->separatorDouble);
            } else {
                fwrite($txt,  $this->htmlToPlainText(0 . $datum->code) . $this->separatorDouble);
            }
            fwrite($txt, $this->htmlToPlainText($datum->industry) . $this->separatorDouble);

            fwrite($txt, $this->htmlToPlainText($datum->type_for_report) . $this->separatorDouble);

            fwrite($txt, $this->htmlToPlainText(0 . $this->separatorDouble));
            fwrite($txt, $this->separatorDouble  . $datum->pcd . $this->separatorDouble);
            fwrite($txt, $this->urlBase . 'job/' . $datum->slug);
            fwrite($txt,  PHP_EOL);
            fwrite($txt,  "\r\n");
        }

        fclose($txt);

        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain',
        ]);
    }
    public function OferentesMensualTxt()
    {
        $file = '';

        $data =  DB::table('users')->join(
            'cities',
            'cities.city_id',
            'users.city_id'
        )->join(
            'states',
            'states.state_id',
            'users.state_id'
        )->join(
            'countries',
            'countries.country_id',
            'users.country_id'
        )->selectRaw('"02" as codigo, users.id, users.national_id_card_number, country, cities.code, state, DATE_FORMAT(users.created_at,"%d%m%Y") as date')
            ->where('users.is_active', 1)
            ->where('users.verified', 1)
            ->where(
                'countries.lang',
                'es'
            )->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
            })->get();

        $file = 'DBO' . $this->codeIes . Carbon::now()->format('mY') .  ".txt";

        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, '01' . $this->separatorSingle);
        fwrite($txt, $this->codeIes . $this->separatorSingle);
        fwrite($txt, count($data) + 2 . $this->separatorSingle);
        fwrite($txt, Carbon::now()->format('dmY'));
        fwrite($txt,  PHP_EOL);
        fwrite($txt,  "\r\n");

        foreach ($data as $datum) {
            fwrite($txt, $datum->codigo . $this->separatorSingle);
            fwrite($txt, $this->codeIes . $this->separatorSingle);
            fwrite($txt, 1 . $this->separatorSingle);
            fwrite($txt, $datum->national_id_card_number . $this->separatorSingle);
            fwrite($txt, 'CO' . $this->separatorSingle);
            fwrite($txt, substr($datum->code, 0, 2) . $this->separatorSingle);
            fwrite($txt, substr($datum->code, 2, 5) . $this->separatorSingle);
            fwrite($txt, $datum->date);
            fwrite($txt,  PHP_EOL);
            fwrite($txt,  "\r\n");
        }

        fwrite($txt, 99 . $this->separatorSingle);
        fwrite($txt, $this->codeIes . $this->separatorSingle);
        fwrite($txt, count($data) . $this->separatorSingle);
        fwrite($txt, count($data) . $this->separatorSingle);
        fwrite($txt, Carbon::now()->format('dmY'));
        fwrite($txt,  PHP_EOL);
        fwrite($txt,  "\r\n");
        fclose($txt);

        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain',
        ]);
    }
    public function OferentesSemestralTxt()
    {
        $data = User::with([
            'city' => function ($q) {
                $q->select(
                    'city_id',
                    'city',
                    'lang',
                    'code'
                );
            },
            'country' => function ($q) {
                $q->select(
                    'country_id',
                    'country',
                    'lang'
                )->where(
                    'lang',
                    'es'
                );
            },
            'state' => function ($q) {
                $q->select(
                    'state_id',
                    'state',
                    'lang'
                );
            },
            'cityborn' => function ($q) {
                $q->select(
                    'city_id',
                    'city',
                    'lang',
                    'code'
                );
            },
            'countryborn' => function ($q) {
                $q->select(
                    'country_id',
                    'country',
                    'lang'
                )->where(
                    'lang',
                    'es'
                );
            },
            'stateborn' => function ($q) {
                $q->select(
                    'state_id',
                    'state',
                    'lang'
                );
            },
            'profileEducation',
            'profileExperience'
        ])->when(request()->get('inicio') && request()->get('fin'), function ($q) {
            $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
        })->get();

        ob_end_clean();
        ob_start();

        $file = 'IBHV' . $this->codeIes . Carbon::now()->format('mY') .  ".txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        fwrite($txt, '01' . $this->separatorSingle);
        fwrite($txt, $this->codeIes . $this->separatorSingle);
        fwrite($txt, count($data) + 2 . $this->separatorSingle);

        fwrite($txt, Carbon::now()->format('dmY'));
        fwrite($txt,  PHP_EOL);
        fwrite($txt,  "\r\n");

        foreach ($data as $datum) {

            $divipola_code = null;

            if (isset($datum->city))  $divipola_code = str_pad($datum->city->code, 5, '0', STR_PAD_LEFT);

            fwrite($txt, '02' . $this->separatorSingle);
            fwrite($txt, $this->codeIes . $this->separatorSingle);
            fwrite($txt, Carbon::parse($datum->date_of_birth)->format('dmY') . $this->separatorSingle);
            fwrite($txt, 'CO' . $this->separatorSingle);

            fwrite($txt, (isset($datum->cityborn)) ? substr($divipola_code, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle);
            fwrite($txt, (isset($datum->cityborn)) ? substr($divipola_code, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle);
            fwrite($txt, ($datum->gender_id == 1) ? 1 . $this->separatorSingle : 2  . $this->separatorSingle);
            fwrite($txt, 'CO' . $this->separatorSingle);
            fwrite($txt, (isset($datum->city)) ? substr($divipola_code, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle);
            fwrite($txt, (isset($datum->city)) ? substr($divipola_code, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle);

            $studies = [];

            $item  = $datum->profileEducation->whereIn('degree_level_id', [111, 109, 110])->sortByDesc('qualification')->first();
            if ($item) $studies[0] = $item;

            if (isset($studies) && count($studies) > 0) {
                $item  = $datum->profileEducation->where('degree_level_id', 107)->first();
                if ($item) $studies[1] = $item;
            } else {
                $item  = $datum->profileEducation->sortByDesc('qualification')->first();
                if ($item) $studies[0] = $item;
            }

            if (count($studies) > 0) {
                foreach ($studies as $edu) {
                    fwrite($txt, 'FA' . $this->separatorSingle);
                    $estadoFormacion = 2;
                    if (($edu->date_completion && $edu->date_completion < Carbon::now()->format('Y')) && $edu->degree_result == "NA") $estadoFormacion = 3;
                    if (($edu->date_completion && $edu->date_completion >= Carbon::now()->format('Y')) && $edu->degree_result != "NA") $estadoFormacion = 1;

                    fwrite($txt, $edu->degree_title . $this->separatorSingle);
                    fwrite($txt, $edu->degreeLevel->qualification . $this->separatorSingle);
                    fwrite($txt, $this->getFieldDate($edu->date_completion) . $this->separatorSingle);
                    fwrite($txt, $estadoFormacion . $this->separatorSingle);
                    fwrite($txt, 'CO' . $this->separatorSingle);
                }
            } else {
                fwrite($txt, 'FA' . $this->separatorSingle);
            }

            if (isset($datum->profileExperience) && count($datum->profileExperience) > 0) {
                foreach ($datum->profileExperience as $exp) {

                    fwrite($txt, 'EL' . $this->separatorSingle);
                    fwrite($txt,  $exp->position . $this->separatorSingle);

                    $profession = '';
                    if ($exp->profession) $profession = DB::table('professions')->where('name', $exp->profession)->first();

                    fwrite($txt, ($profession) ? $profession->id . $this->separatorSingle : '' . $this->separatorSingle);
                    fwrite($txt, 'CO' . $this->separatorSingle);

                    if (isset($exp->load('city')->city->code))  $expCity = str_pad($exp->load('city')->city->code, 5, '0', STR_PAD_LEFT);

                    fwrite($txt, (isset($expCity)) ? substr($expCity, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle);
                    fwrite($txt, (isset($expCity)) ? substr($expCity, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle);
                    fwrite($txt, Carbon::parse($exp->date_start)->format('dmY') . $this->separatorSingle);
                    fwrite($txt, Carbon::parse($exp->date_end)->format('dmY') . $this->separatorSingle);
                }
            } else {
                fwrite($txt, 'EL' . $this->separatorSingle);
            }

            $s = 11;
            $b = $this->baseSalary;
            $mi = $this->htmlToPlainText($this->getOnlyNumbers($datum->expected_salary));

            if ($mi < $b)  $s = 1;
            if ($mi == $b)  $s = 2;
            if ($mi >= $b && $mi < 2 * $b)  $s = 3;
            if ($mi >= 2 * $b && $mi < 4 * $b)  $s = 4;
            if ($mi >= 4 * $b && $mi < 6 * $b)  $s = 5;
            if ($mi >= 6 * $b && $mi < 9 * $b)  $s = 6;
            if ($mi >= 9 * $b && $mi < 12 * $b)  $s = 7;
            if ($mi >= 12 * $b && $mi < 15 * $b)  $s = 8;
            if ($mi >= 15 * $b && $mi < 19 * $b)  $s = 9;
            if ($mi >= 20 * $b) $s = 10;

            fwrite($txt, 'MO' . $this->separatorSingle);
            fwrite($txt, $s);
            fwrite($txt,  PHP_EOL);
            fwrite($txt,  "\r\n");
        }

        $countSex = 0;
        foreach ($data as $datum) $countSex +=  ($datum->gender_id == 1) ? 1 : 2;

        fwrite($txt, 99 . $this->separatorSingle);
        fwrite($txt, $this->codeIes . $this->separatorSingle);
        fwrite($txt, count($data) . $this->separatorSingle);
        fwrite($txt, $countSex . $this->separatorSingle);
        fwrite($txt, Carbon::now()->format('dmY'));
        fwrite($txt,  PHP_EOL);
        fwrite($txt,  "\r\n");
        fclose($txt);


        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain',
        ]);
    }
    public function  getFieldDate($field)
    {
        if (isset($field)) return Carbon::parse($field)->format('dmY');
        else return '';
    }
}
