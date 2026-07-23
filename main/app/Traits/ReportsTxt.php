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
    protected $baseSalary = 1750905;

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
        )->leftJoin(
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
                $q->whereBetween('jobs.created_at', [Carbon::parse(request()->get('inicio'))->startOfDay(), Carbon::parse(request()->get('fin'))->endOfDay()]);
            })->get();

        $file = $this->codeIes . Carbon::now()->format('Ymd') . ".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->codeIes . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->id . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->title) . $this->separatorDouble));

            fwrite($txt, $this->htmlToPlainText($datum->description) . $this->separatorDouble);

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->experience_for_report . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->qualification_2019) . $this->separatorDouble));

            if (in_array($datum->qualification_2019, [5, 6, 7, 8, 9, 11])) {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->functional_area) . $this->separatorDouble));
            } else {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText('NA') . $this->separatorDouble));
            }

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->getSalary($datum->salary_from, $datum->salary_to) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->num_of_positions . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->position) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', 1 . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->identificacion . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->name) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->not . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', Carbon::parse($datum->created_at)->format('d/m/Y') . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', Carbon::parse($datum->expiry_date)->format('d/m/Y') . $this->separatorDouble));

            if (strlen($datum->code) == 5) {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->code) . $this->separatorDouble));
            } else {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(0 . $datum->code) . $this->separatorDouble));
            }
            //TODO error on relationship
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->industry) . $this->separatorDouble));

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->type_for_report) . $this->separatorDouble));

            if ($datum->is_freelance) {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(1 . $this->separatorDouble)));
            } else {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(0 . $this->separatorDouble)));
            }
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->separatorDouble  . $datum->pcd . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->urlBase . 'job/' . $datum->slug));
            fwrite($txt, PHP_EOL);
        }
        fclose($txt);


        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . basename($file) . '"',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-type' => 'text/plain; charset=us-ascii',
        ])->deleteFileAfterSend(true);
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
            'industries.code_for_report',
            'job_types.type_for_report',
            'jobs.is_freelance',
            'jobs.slug',
            'jobs.pcd',
            'jobs.to_publish',
        ])->where('job_experiences.is_default', 1)
            ->where('job_types.is_default', 1)
            ->where('jobs.is_pl', 1)
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('jobs.created_at', [Carbon::parse(request()->get('inicio'))->startOfDay(), Carbon::parse(request()->get('fin'))->endOfDay()]);
            })->get();

        $file =  'PL' . $this->codeIes . Carbon::now()->format('Ymd') .  ".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");

        // dd($data->whereNull('position'));

        foreach ($data as $datum) {
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->codeIes . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->id . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', 'PL-' . $this->htmlToPlainText($datum->title) . $this->separatorDouble));

            // $texto_sin_entidades = html_entity_decode($this->htmlToPlainText($datum->description), ENT_QUOTES | ENT_HTML5, 'UTF-8');

            // fwrite($txt, $texto_sin_entidades . $this->separatorDouble);

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->description) . $this->separatorDouble));

            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', 0 . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->qualification_319) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->functional_area) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->getSalary($datum->salary_from, $datum->salary_to, $datum->id) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->num_of_positions . $this->separatorDouble));
            $profess =  DB::table('professions')->where('name', $datum->position)->first();

            if ($profess) {

                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText('000' . substr($profess->code ?? 0, 0, 1)) . $this->separatorDouble));

            } else {

                dd($datum);

            }


            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', 1 . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $datum->identificacion . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->name) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->not . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', Carbon::parse($datum->created_at)->format('d/m/Y') . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', Carbon::parse($datum->expiry_date)->format('d/m/Y') . $this->separatorDouble));
            if (strlen($datum->code) == 5) {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->code) . $this->separatorDouble));
            } else {
                fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(0 . $datum->code) . $this->separatorDouble));
            }
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(str_pad($datum->code_for_report, 4, '0', STR_PAD_LEFT)) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText($datum->type_for_report) . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->htmlToPlainText(0 . $this->separatorDouble)));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->separatorDouble  . $datum->pcd . $this->separatorDouble));
            fwrite($txt, iconv('UTF-8', 'ASCII//TRANSLIT', $this->urlBase . 'job/' . $datum->slug));
            fwrite($txt, PHP_EOL);
        }

        fclose($txt);

        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . basename($file) . '"',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-type' => 'text/plain; charset=us-ascii',
        ])->deleteFileAfterSend(true);
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
                $q->whereBetween('users.created_at', [Carbon::parse(request()->get('inicio'))->startOfDay(), Carbon::parse(request()->get('fin'))->endOfDay()]);
            })->get();

        $file = 'DBO' . $this->codeIes . Carbon::now()->format('mY') .  ".txt";

        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, iconv('UTF-8', 'Windows-1252', '01' . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', count($data) + 2 . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::now()->format('dmY')));
        fwrite($txt, PHP_EOL);
        foreach ($data as $datum) {
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $datum->codigo . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', 1 . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $datum->national_id_card_number . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', ($datum->code) ? 'CO' . $this->separatorSingle : '' . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', substr($datum->code, 0, 2) . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', substr($datum->code, 2, 5) . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $datum->date));
            fwrite($txt, PHP_EOL);
        }

        fwrite($txt, iconv('UTF-8', 'Windows-1252', 99 . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', count($data) . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', count($data) . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::now()->format('dmY')));
        fwrite($txt, PHP_EOL);
        fclose($txt);



        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . basename($file) . '"',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain; charset=windows-1252',
        ])->deleteFileAfterSend(true);
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
                    'ISO',
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
                    'ISO',
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
            $q->whereBetween('users.created_at', [Carbon::parse(request()->get('inicio'))->startOfDay(), Carbon::parse(request()->get('fin'))->endOfDay()]);
        })->get();

        ob_end_clean();
        ob_start();

        $file = 'IBHV' . $this->codeIes . Carbon::now()->format('mY') .  ".txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        fwrite($txt, iconv('UTF-8', 'Windows-1252', '01' . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', count($data) + 2 . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::now()->format('dmY')));
        fwrite($txt, PHP_EOL);
        foreach ($data as $datum) {

            $divipola_code = null;
            $divipola_born_code = null;

            if (isset($datum->city)) {
                $divipola_code = str_pad($datum->city->code, 5, '0', STR_PAD_LEFT);
            }
            if (isset($datum->cityborn)) {
                $divipola_born_code = str_pad($datum->cityborn->code, 5, '0', STR_PAD_LEFT);
            }

            fwrite($txt, iconv('UTF-8', 'Windows-1252', '02' . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::parse($datum->date_of_birth)->format('dmY') . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', ($datum->countryborn) ? $datum->countryborn->ISO . $this->separatorSingle : '' . $this->separatorSingle));
            
            $isCO = ($datum->countryborn) && ($datum->countryborn->ISO === 'CO');
            fwrite($txt, iconv('UTF-8', 'Windows-1252', (!$isCO) ? '' . $this->separatorSingle : ((isset($datum->cityborn)) ? substr($divipola_born_code, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle)));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', (!$isCO) ? '' . $this->separatorSingle : ((isset($datum->cityborn)) ? substr($divipola_born_code, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle)));
            
            fwrite($txt, iconv('UTF-8', 'Windows-1252', ($datum->gender_id == 1) ? 1 . $this->separatorSingle : 2  . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', ($datum->country) ? $datum->country->ISO  . $this->separatorSingle : '' . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', (isset($datum->city)) ? substr($divipola_code, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', (isset($datum->city)) ? substr($divipola_code, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle));

            $studies = [];

            $item  = $datum->profileEducation->whereIn('degree_level_id', [111, 109, 110])->sortByDesc('qualification')->first();
            if ($item) {
                $studies[0] = $item;
            }

            if (isset($studies) && count($studies) > 0) {
                $item  = $datum->profileEducation->where('degree_level_id', 107)->first();
                if ($item) {
                    $studies[1] = $item;
                }
            } else {

                $levels  = $datum->profileEducation->pluck('degree_level_id')->toArray();

                $qualification = DB::table('degree_levels')->whereIn('degree_level_id', $levels)->orderBy('qualification', 'DESC')->first();

                // if($qualification) dd($qualification);

                if ($qualification) {
                    $item =  $datum->profileEducation->where('degree_level_id', $qualification->degree_level_id)->first();
                }

                if ($item) {
                    $studies[0] = $item;
                }
            }

            if (count($studies) > 0) {
                foreach ($studies as $edu) {

                    fwrite($txt, iconv('UTF-8', 'Windows-1252', 'FA' . $this->separatorSingle));
                    $estadoFormacion = 2;

                    $now = Carbon::now();
                    $currentYearMonth = $now->format('Y-m');

                    if ($edu->degree_result != "NA") {
                        $estadoFormacion = 1;
                    }
                    if (($edu->date_completion && Carbon::parse($edu->date_completion)->format('Y-m') < $currentYearMonth)  && ($edu->degree_result == "NA" || $edu->degree_result == "" || $edu->degree_result == null)) {
                        $estadoFormacion = 3;
                    }
                    if (($edu->date_completion && $edu->date_completion >= Carbon::now()->format('Y')) && $edu->degree_result != "NA") {
                        $estadoFormacion = 1;
                    }
                    $profess =  DB::table('titles')->where('name', $edu->degree_title)->first();

                    fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->htmlToPlainText($profess->id ?? '') . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', $edu->degreeLevel->qualification . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', ($estadoFormacion == 1 || $estadoFormacion == 2) ? '' . $this->separatorSingle : $this->getFieldDate($edu->date_completion) . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', $estadoFormacion . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', 'CO' . $this->separatorSingle));

                }
            } else {
                fwrite($txt, iconv('UTF-8', 'Windows-1252', 'FA' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->htmlToPlainText('') . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
            }

            if (isset($datum->profileExperience) && count($datum->profileExperience) > 0) {
                foreach ($datum->profileExperience as $exp) {

                    fwrite($txt, iconv('UTF-8', 'Windows-1252', 'EL' . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->htmlToPlainText($exp->position) . $this->separatorSingle));
                    $profession = '';
                    if ($exp->profession) {
                        $profession = DB::table('professions')->where('name', $exp->profession)->first();
                    }
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', ($profession) ? preg_replace("/\./", "", $profession->code)  . $this->separatorSingle : '' . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', 'CO' . $this->separatorSingle));
                    if (isset($exp->load('city')->city->code)) {
                        $expCity = str_pad($exp->load('city')->city->code, 5, '0', STR_PAD_LEFT);
                    }
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', (isset($expCity)) ? substr($expCity, 0, 2) . $this->separatorSingle : '' . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', (isset($expCity)) ? substr($expCity, 2, 5) . $this->separatorSingle : '' . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::parse($exp->date_start)->format('dmY') . $this->separatorSingle));
                    fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::parse($exp->date_end)->format('dmY') . $this->separatorSingle));
                }
            } else {
                fwrite($txt, iconv('UTF-8', 'Windows-1252', 'EL' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
                fwrite($txt, iconv('UTF-8', 'Windows-1252', '' . $this->separatorSingle));
            }

            $s = 11;
            $b = $this->baseSalary;
            $mi = $this->htmlToPlainText($this->getOnlyNumbers($datum->expected_salary));

            if ($mi < $b) {
                $s = 1;
            }
            if ($mi == $b) {
                $s = 2;
            }
            if ($mi >= $b && $mi < 2 * $b) {
                $s = 3;
            }
            if ($mi >= 2 * $b && $mi < 4 * $b) {
                $s = 4;
            }
            if ($mi >= 4 * $b && $mi < 6 * $b) {
                $s = 5;
            }
            if ($mi >= 6 * $b && $mi < 9 * $b) {
                $s = 6;
            }
            if ($mi >= 9 * $b && $mi < 12 * $b) {
                $s = 7;
            }
            if ($mi >= 12 * $b && $mi < 15 * $b) {
                $s = 8;
            }
            if ($mi >= 15 * $b && $mi < 19 * $b) {
                $s = 9;
            }
            if ($mi >= 20 * $b) {
                $s = 10;
            }

            fwrite($txt, iconv('UTF-8', 'Windows-1252', 'MO' . $this->separatorSingle));
            fwrite($txt, iconv('UTF-8', 'Windows-1252', $s));
            fwrite($txt, PHP_EOL);
        }

        $countSex = 0;
        foreach ($data as $datum) {
            $countSex +=  ($datum->gender_id == 1) ? 1 : 2;
        }

        fwrite($txt, iconv('UTF-8', 'Windows-1252', 99 . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', $this->codeIes . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', count($data) . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', $countSex . $this->separatorSingle));
        fwrite($txt, iconv('UTF-8', 'Windows-1252', Carbon::now()->format('dmY')));
        fwrite($txt, PHP_EOL);
        fclose($txt);


        return response()->download($file, basename($file), [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . basename($file) . '"',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
            'Content-Length' => filesize($file),
            'Content-Type' => 'text/plain; charset=windows-1252',
        ])->deleteFileAfterSend(true);
    }
    public function getFieldDate($field)
    {
        if (isset($field)) {
            return Carbon::parse($field)->format('dmY');
        } else {
            return '';
        }
    }
}
