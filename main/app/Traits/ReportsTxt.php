<?php

namespace App\Traits;

use App\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ReportsTxt
{
    public function PositionsTxt()
    {
        $data = Job::join('companies', 'companies.id', 'jobs.company_id')

            ->join('job_experiences', 'job_experiences.job_experience_id', 'jobs.job_experience_id')

            ->join('functional_areas', 'functional_areas.functional_area_id', 'jobs.functional_area_id')

            ->join('degree_levels', 'degree_levels.degree_level_id', 'jobs.degree_level_id')

            ->join('industries', 'industries.industry_id', 'companies.industry_id')

            ->join('job_types', 'job_types.job_type_id', 'jobs.job_type_id')

            ->join('cities', 'cities.city_id', 'jobs.city_id')

            ->select([

                'jobs.company_id',

                'jobs.id',

                'jobs.title',

                'jobs.description',

                'job_experiences.job_experience',

                'functional_areas.functional_area',

                'degree_levels.qualification',

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
            ])
            ->where('job_experiences.is_default', 1)
            ->where('job_types.is_default', 1)
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();

        $file = "reporteVacantes.txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {

            fwrite($txt,        22235 . '|$$|');

            fwrite($txt,        $datum->id . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->title) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->description) . '|$$|');

            fwrite($txt,        $this->replaceyears($datum->job_experience) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->qualification) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->functional_area) . '|$$|');

            fwrite($txt,        $this->getSalary($datum->salary_from, $datum->salary_to) . '|$$|');

            fwrite($txt,        $datum->num_of_positions . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->position) . '|$$|');

            fwrite($txt,        1 . '|$$|');

            fwrite($txt,        $datum->identificacion . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->name) . '|$$|');

            fwrite($txt,        'N' . '|$$|');

            fwrite($txt,        Carbon::parse($datum->created_at)->format('d/m/Y') . '|$$|');

            fwrite($txt,        Carbon::parse($datum->expiry_date)->format('d/m/Y') . '|$$|');

            fwrite($txt,        strlen($datum->code) == 5 ? $datum->code : 0 . $datum->code  . '|$$|');

            fwrite($txt,        '|$$|' . $this->htmlToPlainText($datum->industry) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->type_for_report) . '|$$|');

            fwrite($txt, ($datum->is_freelance) ? '1' : '0') . '|$$|';

            fwrite($txt,        '|$$|' . '0' . '|$$|');

            fwrite($txt,       'https://bolsaempleo.iescinoc.edu.co/job/' . $datum->slug);

            fwrite($txt,  PHP_EOL);

            fwrite($txt,  "\r\n");
        }

        fclose($txt);

        header('Content-Description: File Transfer');

        header('Content-Disposition: attachment; filename=' . basename($file));

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length: ' . filesize($file));

        header("Content-Type: text/plain");

        return readfile($file);
    }

    public function PracticasLaboralesTxt()
    {
        $data = Job::join('companies', 'companies.id', 'jobs.company_id')

            ->join('job_experiences', 'job_experiences.job_experience_id', 'jobs.job_experience_id')

            ->join('functional_areas', 'functional_areas.functional_area_id', 'jobs.functional_area_id')

            ->join('degree_levels', 'degree_levels.degree_level_id', 'jobs.degree_level_id')

            ->join('industries', 'industries.industry_id', 'companies.industry_id')

            ->join('job_types', 'job_types.job_type_id', 'jobs.job_type_id')

            ->join('cities', 'cities.city_id', 'jobs.city_id')

            ->select([

                'jobs.company_id',

                'jobs.id',

                'jobs.title',

                'jobs.description',

                'job_experiences.job_experience',

                'functional_areas.functional_area',

                'degree_levels.qualification',

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
            ])
            ->where('job_experiences.is_default', 1)
            ->where('job_types.is_default', 1)
            ->where('jobs.is_pl', 1)
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();

        $file = "reporteVacantes.txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {

            fwrite($txt,        22235 . '|$$|');

            fwrite($txt,        $datum->id . '|$$|');

            fwrite($txt,       'PL-' . $this->htmlToPlainText($datum->title) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->description) . '|$$|');

            fwrite($txt,        $this->replaceyears($datum->job_experience) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->qualification) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->functional_area) . '|$$|');

            fwrite($txt,        $this->getSalary($datum->salary_from, $datum->salary_to) . '|$$|');

            fwrite($txt,        $datum->num_of_positions . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->position) . '|$$|');

            fwrite($txt,        1 . '|$$|');

            fwrite($txt,        $datum->identificacion . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->name) . '|$$|');

            fwrite($txt,        'N' . '|$$|');

            fwrite($txt,        Carbon::parse($datum->created_at)->format('d/m/Y') . '|$$|');

            fwrite($txt,        Carbon::parse($datum->expiry_date)->format('d/m/Y') . '|$$|');

            fwrite($txt,        strlen($datum->code) == 5 ? $datum->code : 0 . $datum->code  . '|$$|');

            fwrite($txt,        '|$$|' . $this->htmlToPlainText($datum->industry) . '|$$|');

            fwrite($txt,        $this->htmlToPlainText($datum->type_for_report) . '|$$|');

            fwrite($txt, ($datum->is_freelance) ? '1' : '0') . '|$$|';

            fwrite($txt,        '|$$|' . '0' . '|$$|');

            fwrite($txt,       'https://bolsaempleo.iescinoc.edu.co/job/' . $datum->slug);

            fwrite($txt,  PHP_EOL);

            fwrite($txt,  "\r\n");
        }

        fclose($txt);

        header('Content-Description: File Transfer');

        header('Content-Disposition: attachment; filename=' . basename($file));

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length: ' . filesize($file));

        header("Content-Type: text/plain");

        return readfile($file);
    }

    public function OferentesMensualTxt()
    {
        $file = '';

        $data =  DB::table('users')

            ->join('cities', 'cities.city_id', 'users.city_id')

            ->join('states', 'states.state_id', 'users.state_id')

            ->join('countries', 'countries.country_id', 'users.country_id')

            ->selectRaw('"02" as codigo, users.id, users.national_id_card_number, country, cities.code, state, DATE_FORMAT(users.created_at,"%d%m%Y") as date')

            ->where('users.is_active', 1)

            ->where('users.verified', 1)

            ->where('countries.lang', 'es')

            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();

        $file = "OferentesMensual.txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        fwrite($txt,        01 . '|$|');

        fwrite($txt,        22235 . '|$|');

        fwrite($txt,        count($data) + 2 . '|$|');

        fwrite($txt,        Carbon::now()->format('dmY'));

        fwrite($txt,  PHP_EOL);

        fwrite($txt,  "\r\n");

        foreach ($data as $datum) {

            fwrite($txt,        $datum->codigo . '|$|');

            fwrite($txt,        22235 . '|$|');

            fwrite($txt,        1 . '|$|');

            fwrite($txt,        $datum->national_id_card_number . '|$|');

            fwrite($txt,        'CO' . '|$|');

            fwrite($txt,           substr($datum->code, 0, 2) . '|$|');

            fwrite($txt,           substr($datum->code, 2, 5) . '|$|');

            fwrite($txt,        $datum->date);

            fwrite($txt,  PHP_EOL);

            fwrite($txt,  "\r\n");
        }

        fwrite($txt,        99 . '|$|');

        fwrite($txt,        22235 . '|$|');

        fwrite($txt,        count($data) . '|$|');

        fwrite($txt,        count($data) . '|$|');

        fwrite($txt,        Carbon::now()->format('dmY'));

        fwrite($txt,  PHP_EOL);

        fwrite($txt,  "\r\n");

        fclose($txt);

        header('Content-Description: File Transfer');

        header('Content-Disposition: attachment; filename=' . basename($file));

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length: ' . filesize($file));

        header("Content-Type: text/plain");

        return readfile($file);
    }

    public function OferentesSemestralTxt()
    {

        $data = User::with([
            'city' => function ($q) {
                $q->select('city_id', 'city', 'lang', 'code');
            },
            'country' => function ($q) {
                $q->select('country_id', 'country', 'lang')->where('lang', 'es');
            },
            'state' => function ($q) {
                $q->select('state_id', 'state', 'lang');
            },
            'profileEducation',
            'profileExperience'

        ])
            ->when(request()->get('inicio') && request()->get('fin'), function ($q) {
                $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
            })

            ->get();


        $file = "test.txt";

        $txt = fopen($file, "w") or die("Unable to open file!");

        foreach ($data as $datum) {

            fwrite($txt,        '02' . '|');

            fwrite($txt,        '00000' . '|');

            fwrite($txt,         Carbon::parse($datum->date_of_birth)->format('dmY') . '|');

            fwrite($txt,         169 . '|');

            fwrite($txt, (isset($datum->city)) ? substr($datum->city->code, 0, 2) . '|' : '' . '|');

            fwrite($txt, (isset($datum->city)) ? substr($datum->city->code, 2, 5) . '|' : '' . '|');

            fwrite($txt, ($datum->gender_id == 1) ? 1 . '|' : 2  . '|');

            fwrite($txt,         169 . '|');

            fwrite($txt, (isset($datum->city)) ? substr($datum->city->code, 0, 2) . '|' : '' . '|');

            fwrite($txt, (isset($datum->city)) ? substr($datum->city->code, 2, 5) . '|' : '' . '|');

            fwrite($txt,        'FA' . '|');

            foreach ($datum->profileEducation as $edu) {

                fwrite($txt,        $edu->degree_title . '|');

                fwrite($txt,        $edu->degreeLevel->degree_level . '|');

                fwrite($txt,        Carbon::parse($edu->degreeLevel->date_completion)->format('dmY') . '|');

                fwrite($txt,        $edu->degreeLevel->degree_result . '|');

                fwrite($txt,        169 . '|');
            }

            fwrite($txt,        'EL' . '|');

            foreach ($datum->profileExperience as $exp) {

                fwrite($txt,        $exp->title . '|');

                fwrite($txt,        169 . '|');

                fwrite($txt, (isset($exp->load('city')->city->code)) ? substr($exp->load('city')->city->code, 0, 2) . '|' : '' . '|');

                fwrite($txt, (isset($exp->load('city')->city->code)) ? substr($exp->load('city')->city->code, 0, 2) . '|' : '' . '|');

                fwrite($txt,        Carbon::parse($exp->date_start)->format('dmY') . '|');

                fwrite($txt,        Carbon::parse($exp->date_end)->format('dmY') . '|');
            }

            $s = 11;

            $b = 1000000;

            $mi = $this->htmlToPlainText($datum->expected_salary);

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

            fwrite($txt,        'MO' . '|');

            fwrite($txt,         $s);

            fwrite($txt,  PHP_EOL);

            fwrite($txt,  "\r\n");
        }

        fclose($txt);

        header('Content-Description: File Transfer');

        header('Content-Disposition: attachment; filename=' . basename($file));

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length: ' . filesize($file));

        header("Content-Type: text/plain");

        return readfile($file);
    }
}
