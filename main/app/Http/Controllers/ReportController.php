<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use DB;
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
use Carbon\Carbon;

class ReportController extends Controller
{

    public function showView()
    {
      return view('reports.reports');
      
    }
    
    
    public function htmlToPlainText($str){
    $str = str_replace('&nbsp;', ' ', $str);
    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
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


    public function replaceyears($years){
        
         $years = str_replace(
            array('a','n','o','s', 'ñ'),
            array('', '', '', '', ''),
            $years
        );
        
        return (int)$years * 12;
    }
    
    public function download()
    {

        $data = [];
        
        switch(request()->get('tipo_reporte')){
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
        ->where('job_types.lang', 'es')
        ->when(request()->get('inicio') && request()->get('fin'), function($q){ $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]); })
        ->get();
        
        
        $file = "test.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        
        $pattern = "/[^0-9]/";
        
        foreach($data as $datum){
            
                    fwrite($txt,        22235 . '|$$|' );
                    fwrite($txt,        $datum->id. '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->title). '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText( $datum->description ) . '|$$|' );
                    
                    fwrite($txt,        $this->replaceyears($datum->job_experience) . '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->qualification) . '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->functional_area) . '|$$|' );
                    fwrite($txt,        preg_replace($pattern, "", $datum->salary_from) . '-' . preg_replace($pattern, "", $datum->salary_to) . '|$$|' );
                    fwrite($txt,        $datum->num_of_positions . '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->position) . '|$$|' );
                    
                    fwrite($txt,        1 . '|$$|' );
                    
                    fwrite($txt,        $datum->identificacion . '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->name) . '|$$|' );
                    fwrite($txt,        'N' . '|$$|' );
                    fwrite($txt,        Carbon::parse($datum->created_at)->format('d/m/Y'). '|$$|' );
                    fwrite($txt,        Carbon::parse($datum->expiry_date)->format('d/m/Y') . '|$$|' );
                    
                    
                    fwrite($txt,        strlen($datum->code) == 5 ? $datum->code : 0 . $datum->code  . '|$$|' );
                    
                    fwrite($txt,        '|$$|' . $this->htmlToPlainText($datum->industry) . '|$$|' );
                    fwrite($txt,        $this->htmlToPlainText($datum->type_for_report) . '|$$|' );
                    
                    fwrite($txt,        ($datum->is_freelance) ? '1' : '0' ) . '|$$|';
                    fwrite($txt,        '|$$|' . '0' . '|$$|' );
                    fwrite($txt,       'https://bolsaempleo.iescinoc.edu.co/job/' .$datum->slug  );
            
            
                    fwrite($txt,  PHP_EOL );
                    fwrite($txt,  "\r\n" );
        }
        
        
        
        fclose($txt);
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);


            case 10:
            $data = DB::table('users')
            ->join('cities', 'cities.city_id', 'users.city_id')
            ->join('states', 'states.state_id', 'users.state_id')
            ->join('countries', 'countries.country_id', 'users.country_id')
            ->selectRaw('"02" as codigo, users.id, users.national_id_card_number, country, cities.code, state, DATE_FORMAT(users.created_at,"%d%m%Y") as date')
            ->where('users.is_active', 1)
            ->where('users.verified', 1)
            ->where('countries.lang', 'es')
        ->when(request()->get('inicio') && request()->get('fin'), function($q){ $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]); })
        ->get();
        
        $file = "test.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        foreach($data as $datum){
            
                    fwrite($txt,        $datum->codigo. '|' );
                    fwrite($txt,        00000 . '|' );
                    fwrite($txt,        1 . '|' );
                    // fwrite($txt,        $datum->tipo_identificacion. '|' );
                    fwrite($txt,        $datum->national_id_card_number. '|' );
                    fwrite($txt,        169 . '|' );
                    // fwrite($txt,        $datum->country. '|' );
                    fwrite($txt,           substr($datum->code, 0, 2) . '|' );
                    // fwrite($txt,        $this->htmlToPlainText($datum->code) . '|' );
                    fwrite($txt,           substr($datum->code, 2, 5) . '|' );
                    // fwrite($txt,        $this->htmlToPlainText($datum->state) . '|' );
                    fwrite($txt,        $datum->date . '|' );
                   
            
                    fwrite($txt,  PHP_EOL );
                    fwrite($txt,  "\r\n" );
        }
        
        
        
        fclose($txt);
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);

            case 11:
                   $data = User::with([
                            'city' => function($q){$q->select('city_id','city','lang', 'code');}, 
                            'country' => function($q){$q->select('country_id','country','lang')->where('lang', 'es');},
                            'state'=> function($q){$q->select('state_id','state','lang');}, 
                            'profileEducation', 
                            'profileExperience'
         ])
        ->when(request()->get('inicio') && request()->get('fin'), function($q){ $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]); })
        ->get();
       
        $file = "test.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        foreach($data as $datum){
            
                    // $country = $datum->getCountry('country') ;
                    // $state = $datum->getState('state');
                    // $city = $datum->getCity('city') ;
                    

                    fwrite($txt,        '02' . '|' );
                    fwrite($txt,        '00000' . '|' );
                    fwrite($txt,         Carbon::parse($datum->date_of_birth)->format('dmY') . '|' );
                    fwrite($txt,         169 . '|' );
                    // fwrite($txt,        $country . '|' );
                     fwrite($txt,          (isset($datum->city)) ? substr($datum->city->code, 0, 2) . '|' : '' . '|' );
                    // fwrite($txt,        $state . '|' );
                    // fwrite($txt,        $city . '|' );
                     fwrite($txt,           (isset($datum->city)) ? substr($datum->city->code, 2, 5) . '|' : '' . '|' );
                    fwrite($txt,        ($datum->gender_id == 1) ? 1 . '|' : 2  . '|' );
                    // fwrite($txt,        $country . '|' );
                     fwrite($txt,         169 . '|' );
                    // fwrite($txt,        $state . '|' );
                     fwrite($txt,           (isset($datum->city)) ? substr($datum->city->code, 0, 2) . '|' : '' . '|' );
                    // fwrite($txt,        $city . '|' );
                    fwrite($txt,           (isset($datum->city)) ? substr($datum->city->code, 2, 5) . '|' : '' . '|' );
                    fwrite($txt,        'FA' . '|' );
                    
                    foreach($datum->profileEducation as $edu){
                        
                    fwrite($txt,        $edu->degree_title . '|' );
                    fwrite($txt,        $edu->degreeLevel->degree_level. '|' );
                    fwrite($txt,        Carbon::parse($edu->degreeLevel->date_completion)->format('dmY') . '|' );
                    fwrite($txt,        $edu->degreeLevel->degree_result . '|' );
                    fwrite($txt,        169 . '|' );
                    // fwrite($txt,        $edu->degreeLevel->country . '|' );
                    
                    }
                    
                    fwrite($txt,        'EL' . '|' );
                    foreach($datum->profileExperience as $exp) {
                        

                    fwrite($txt,        $exp->title . '|' );
                    fwrite($txt,        169 . '|' );
                    // fwrite($txt,        $exp->getCountry('country') . '|' );
                    // fwrite($txt,        $exp->getState('state') . '|' );
                     fwrite($txt,          (isset($exp->load('city')->city->code)) ? substr($exp->load('city')->city->code, 0, 2) . '|' : '' . '|' );
                    // fwrite($txt,        $exp->getCity('city') . '|' );
                     fwrite($txt,          (isset($exp->load('city')->city->code)) ? substr($exp->load('city')->city->code, 0, 2) . '|' : '' . '|' );
                    fwrite($txt,        Carbon::parse($exp->date_start)->format('dmY') . '|' );
                    fwrite($txt,        Carbon::parse($exp->date_end)->format('dmY') . '|' );
                   
                                       }
                                       
                                     $s = 11;
                                     $b = 1000000;
                                     $mi = $this->htmlToPlainText($datum->expected_salary);
                                     
                                     if($mi < $b)  $s = 1;
                                     if($mi == $b)  $s = 2;
                                     if($mi >= $b && $mi < 2*$b)  $s = 3;
                                     if($mi >= 2*$b && $mi < 4*$b)  $s = 4;
                                     if($mi >= 4*$b && $mi < 6*$b)  $s = 5;
                                     if($mi >= 6*$b && $mi < 9*$b)  $s = 6;
                                     if($mi >= 9*$b && $mi < 12*$b)  $s = 7;
                                     if($mi >= 12*$b && $mi < 15*$b)  $s = 8;
                                     if($mi >= 15*$b && $mi < 19*$b)  $s = 9;
                                     if($mi >= 20*$b) $s = 10;
                                    
                         
                                    
                                       
                                       
                    
                    fwrite($txt,        'MO' . '|' );
                    fwrite($txt,         $s );
                    fwrite($txt,  PHP_EOL );
                    fwrite($txt,  "\r\n" );
        }
        
        
        
        fclose($txt);
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);

        }
    }
    
    
    public function getStudents(){
        
        return  User::
              leftJoin('countries', 'countries.id', 'users.country_id')
            ->leftJoin('cities', 'cities.id', 'users.city_id')
            ->leftJoin('states', 'states.id', 'users.state_id')
            ->leftJoin('industries', 'industries.id', 'users.industry_id')
            ->leftJoin('career_levels', 'career_levels.id', 'users.career_level_id')
            ->leftJoin('profile_skills', 'profile_skills.user_id', 'users.id')
            ->leftJoin('job_skills', 'job_skills.id', 'profile_skills.job_skill_id')
            ->leftJoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
            ->where('rol','Estudiante')
            
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
                )->when(request()->get('inicio') && request()->get('fin'), function($q){
                        $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
                    })
                    ->groupBy('users.id')
                    ->get();
                
    }
    
    public function getEgresados(){
        
        return  User::
              leftJoin('countries', 'countries.id', 'users.country_id')
            ->leftJoin('cities', 'cities.id', 'users.city_id')
            ->leftJoin('states', 'states.id', 'users.state_id')
            ->leftJoin('industries', 'industries.id', 'users.industry_id')
            ->leftJoin('career_levels', 'career_levels.id', 'users.career_level_id')
            ->leftJoin('profile_skills', 'profile_skills.user_id', 'users.id')
            ->leftJoin('job_skills', 'job_skills.id', 'profile_skills.job_skill_id')
            ->leftJoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
            ->where('rol','Egresado')
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
                )->when(request()->get('inicio') && request()->get('fin'), function($q){
                        $q->whereBetween('users.created_at', [request()->get('inicio'), request()->get('fin')]);
                    })
                    ->groupBy('users.id')
                    ->get();
                
    }
    
    public function getCompanys(){
        
       
        return  Company::
              join('cities', 'cities.id', 'companies.city_id')
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
        ->when(request()->get('inicio') && request()->get('fin'), function($q){
                        $q->whereBetween('companies.created_at', [request()->get('inicio'), request()->get('fin')]);
                    })
        ->get();
                
    }
    
    public function getJobs(){
        
       
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
        ->when(request()->get('inicio') && request()->get('fin'), function($q){
                        $q->whereBetween('jobs.created_at', [request()->get('inicio'), request()->get('fin')]);
                    })
        ->get();
                
                // dd($data);
    }
}