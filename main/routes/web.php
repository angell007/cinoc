<?php



/*

  |--------------------------------------------------------------------------

  | Web Routes

  |--------------------------------------------------------------------------

  |

  | Here is where you can register web routes for your application. These

  | routes are loaded by the RouteServiceProvider within a group which

  | contains the "web" middleware group. Now create something great!

  |

 */

use App\Company;
use App\Job;
use App\Mail\cartaMail;
use App\MaritalStatus;
use App\Models\template_contrato;
use App\User;
use App\JobApply;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
// use Newsletter; 
use Illuminate\Support\Facades\Http;
use App\Exports\Ids;

Route::get('/clear-cache', function () {

  $exitCode = Artisan::call('config:clear');

  $exitCode = Artisan::call('cache:clear');

  $exitCode = Artisan::call('config:cache');

  return 'DONE'; //Return anything

});


Route::post('upload-participant', 'UserController@uploadParticipant')->name('upload-participant');

Route::get('info', array_merge(['uses' => 'Admin\VideoController@indexVideosCap']))->name('info');


Route::get('/getconst/{file}', function ($file) {
    
  $name = $file;
  $user = Auth::user();
  
  $pdf = PDF::loadView('pdf.constancies', compact('name', 'user') );
//   return $pdf->stream('pruebapdf.pdf');
  return $pdf->download($name . '.pdf');
});


Route::get('cv', function(){
    
                        $cvs = User::select('users.id', 'profile_cvs.cv_file as file',
                        'profile_cvs.title as title_cv')
                        ->leftjoin('profile_cvs', 'profile_cvs.user_id', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->get();
    
    return view('orientacion.cv', compact('cvs'));})->name('cv');
Route::get('test', function(){return view('orientacion.test');})->name('test');
Route::get('interview', function(){return view('orientacion.interview');})->name('interview');
Route::get('contrats', function(){return view('orientacion.contrats');})->name('contrats');





Route::get('include', function(){return view('orientacion.include');})->name('include');
Route::get('modals', function(){return view('orientacion.modals');})->name('modals');
Route::get('benefits', function(){return view('orientacion.benefits');})->name('benefits');
Route::get('education', function(){return view('orientacion.education');})->name('education');
Route::get('ruta', function(){return view('orientacion.ruta');})->name('ruta');


    Route::post('send-revision', function(){
        
        
        $user = User::select('users.id', 'users.email', 'users.name' , 'users.id', 'profile_cvs.cv_file as file',
                        'profile_cvs.title as title_cv')
                        ->leftjoin('profile_cvs', 'profile_cvs.user_id', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->first();
                        
                        
        $subject = "Nueva HV para revizar!";

            
        Mail::send('emails.revision', ['user' => $user ], function($msj) use($subject){
    
                $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
                $msj->subject($subject);
                // $msj->to("angellphp@gmail.com","IES CINOC");
                $msj->to("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            
            });
            
            
            return response()->json('enviado');


    })->name('send-revision');





Route::get('/pass', function (Request $request) {
    
                // $response = Http::withHeaders([
                //                                 'Accept: application/vnd.api+json',
                //                                 'Content-Type: application/vnd.api+json',
                //                                 'Authorization: apikey ' . '026d02d1f6a5e8d905c1f9373cf763b1-us5'
                //                                 ])
                // ->post('https://us5.api.mailchimp.com/3.0/lists/2246230697/members/530870e29f7955a4658937024f32bb77', [
            
                // ]);
                // return  $response->body();
          
        //     $response->json();

    
    //  dd(Newsletter::getMember('angellphp@gmail.com'));
        //  dd( Newsletter::hasMember('angellphp@gmail.com')); //returns a boolean
        //  dd(Newsletter::isSubscribed('angellphp@gmail.com'));
        //  dd(Newsletter::getApi());
        dd(Newsletter::unsubscribe('mdgrisalez@misena.edu.co', 'subscribers'));
        // dd(Newsletter::subscribe('angellphp@gmail.com', ['FNAME'=>'Foo', 'LNAME'=>'Bar']));
        // dd(Newsletter::delete('angellphp@gmail.com'));
        // dd(Newsletter::getMembers('subscribers'));
        
        
        
        //   -api_key: "026d02d1f6a5e8d905c1f9373cf763b1-us5"
//   -api_endpoint: "https://us5.api.mailchimp.com/3.0"
        
        // dd(Newsletter::subscribeOrUpdate('angellphp@gmail.com', ['FNAME'=>'Rince','LNAME'=>'Wind'], 'subscribers', ['tags'=> 'Practicantes'])); 2139257, egre 2139253, 
        dd(Newsletter::subscribeOrUpdate('mdgrisalez@misena.edu.co', ['FNAME'=>'Rince','LNAME'=>'Winds'], 'subscribers', ['tags'=>['name'=>'Influencer', 'status'=>'active']]));

    
        // $subject = "Asunto del correo";
        // $for = "mdgrisalez@misena.edu.co";
        // Mail::send('email', [], function($msj) use($subject,$for){
        //     $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
        //     $msj->subject($subject);
        //     $msj->to($for);
        // });
        

// return 'echo';
    
    
            // $mujeres_registradas = User::where("gender_id", "=", "1")->get();
            // $hombres_registrados = User::where("gender_id", "=", "2")->get();
            // $empresas_registradas = User::all();
            // $vacantes = job::all();
            // $cv_mujeres = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("users.gender_id", "=", "1")->get();
            // $contrato_mujeres = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("job_apply.status", "=", "contratado")->where("users.gender_id", "=", "1")->get();
            // $contrato_hombres = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("job_apply.status", "=", "contratado")->where("users.gender_id", "=", "2")->get();
            // $cv_hombres = JobApply::join("users", "users.id", "=", "job_apply.user_id")->where("users.gender_id", "=", "1")->get();
            
            // dd([
                
            //      $mujeres_registradas,
            //      $hombres_registrados,
            //      $empresas_registradas,
            //      $vacantes,
            //      $cv_mujeres,
            //      $contrato_mujeres,
            //      $contrato_hombres,
            //      $cv_hombres 
                 
            //     ]);
            
            
            
    
    // return 'HEM' . date("ymd",strtotime( '2021-08-14 07:00:00') ) . str_pad( 555, 7, "0", STR_PAD_LEFT);
    
    // $2y$10$a.nxlVYTXCZ7xPljSuS./eTjGh37aMBswWS14hhGw5OEQe..gns3u
    // $2y$10$gnKPgJvBY1fiEhH6nV2Xb.Uowo4l7t/k2/rITNVtz8MNi7JE4.rH6
    
    return hash::make('Angell00-7');
});

Route::get('fetch-documents', array_merge(['uses' => 'Admin\UserController@fetchUsersDataDocuments']))->name('fetch.data.documents');
Route::post('letter', array_merge(['uses' => 'UserController@uploadletter']))->name('update.front.profile.letter');
Route::get('letter-delete', array_merge(['uses' => 'UserController@deleteletter']));


Route::get('/send-mail', function (Request $request) {
    

  $formato = template_contrato::find(request()->get('plantilla'));
  
  $empresa = Company::find(request()->get('company'));
  
  $estudiante = User::with('profileEducation')->find(request()->get('user'));
  

  $formato->html =  preg_replace("/@nombre_empresa@/",  $empresa->name, $formato->html);
  $formato->html =  preg_replace("/@nit_empresa@/",  '', $formato->html);
  $formato->html =  preg_replace("/@nombre_estudiante@/",  $estudiante->name . ' ' . $estudiante->last_name, $formato->html);
  $formato->html =  preg_replace("/@documento_estudiante@/",  $estudiante->national_id_card_number, $formato->html);
  
  if (isset($estudiante->profileEducation->institution)) {
    $formato->html =  preg_replace("/@instituto@/",  $estudiante->profileEducation->institution, $formato->html);
  }else{
    $formato->html =  preg_replace("/@instituto@/", '', $formato->html);
  }
  if (isset($estudiante->profileEducation->degree_title)) {
    $formato->html =  preg_replace("/@estudio@/",  $estudiante->profileEducation->degree_title, $formato->html);
  }else{  
    $formato->html =  preg_replace("/@estudio@/",  '', $formato->html);
  }

  $formato->html =  preg_replace("/@modalidad@/",  '', $formato->html);
  
  $formato->html =  preg_replace("/@fecha@/",  Carbon::now('America/Bogota')->locale('es')->isoFormat('LLLL'), $formato->html);

  $data = ['estudiante' => $estudiante, 'empresa' => $empresa, 'formato' => $formato  ];

  $pdf = \App::make('dompdf.wrapper');
  $pdf->setPaper("A4", "portrait");
  $pdf = PDF::loadView('plantilla.base', compact('formato','empresa', 'estudiante'));

  Mail::send('plantilla.mail', $data, function ($message) use ($data, $pdf) {
      
      try{
          $message->to($data["empresa"]['email'], $data["empresa"]['email'])
         ->subject($data["formato"]['nombre'])
         ->attachData($pdf->output(), "carta.pdf");
      }
      catch(\Exception $th)
      {
          return Redirect::back()->withErrors(['msg', 'No se ha podido enviar el email correctamente']);

          dd($th->getMessage());
      }
      
  });

        return redirect()->back()->with('success', 'Email enviado correctamente');   


})->name('send-mail');

$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'front_routes' . DIRECTORY_SEPARATOR;


/* * ******** IndexController ************ */

Route::get('/', 'IndexController@index')->name('index');

Route::post('set-locale', 'IndexController@setLocale')->name('set.locale');

/* * ******** HomeController ************ */

Route::get('home', 'HomeController@index')->name('home');

/* * ******** TypeAheadController ******* */

Route::get('typeahead-currency_codes', 'TypeAheadController@typeAheadCurrencyCodes')->name('typeahead.currency_codes');

/* * ******** FaqController ******* */

Route::get('faq', 'FaqController@index')->name('faq');

/* * ******** CronController ******* */

Route::get('check-package-validity', 'CronController@checkPackageValidity');

/* * ******** Verification ******* */

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');

Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Route::get('company-email-verification/error', 'Company\Auth\RegisterController@getVerificationError')->name('company.email-verification.error');

Route::get('company-email-verification/check/{token}', 'Company\Auth\RegisterController@getVerification')->name('company.email-verification.check');

/* * ***************************** */

// Sociallite Start

// OAuth Routes

Route::get('login/jobseeker/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('login/jobseeker/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/employer/{provider}', 'Company\Auth\LoginController@redirectToProvider');

Route::get('login/employer/{provider}/callback', 'Company\Auth\LoginController@handleProviderCallback');

// Sociallite End

/* * ***************************** */

Route::post('tinymce-image_upload-front', 'TinyMceController@uploadImage')->name('tinymce.image_upload.front');



Route::get('cronjob/send-alerts', 'AlertCronController@index')->name('send-alerts');



Route::post('subscribe-newsletter', 'SubscriptionController@getSubscription')->name('subscribe.newsletter');



/* * ******** OrderController ************ */

include_once($real_path . 'order.php');

/* * ******** CmsController ************ */

include_once($real_path . 'cms.php');

/* * ******** JobController ************ */

include_once($real_path . 'job.php');

/* * ******** ContactController ************ */

include_once($real_path . 'contact.php');

/* * ******** CompanyController ************ */

include_once($real_path . 'company.php');

/* * ******** AjaxController ************ */

include_once($real_path . 'ajax.php');

/* * ******** UserController ************ */

include_once($real_path . 'site_user.php');

/* * ******** User Auth ************ */

Auth::routes();

/* * ******** Company Auth ************ */

include_once($real_path . 'company_auth.php');

/* * ******** Admin Auth ************ */

include_once($real_path . 'admin_auth.php');


/* * ********************************** Custom routes  ************************************************** */

/* * ******** routes to upload file of idCards ************ */

include_once($real_path . 'custom/files.php');


// Route::get('/pruebas',  function () {
//   return Hash::make('secret');
// });


Route::get('blog', 'BlogController@index')->name('blogs');

Route::get('blog/search', 'BlogController@search')->name('blog-search');

Route::get('blog/{slug}', 'BlogController@details')->name('blog-detail');

Route::get('/blog/category/{blog}', 'BlogController@categories')->name('blog-category');

Route::get('/company-change-message-status', 'CompanyMessagesController@change_message_status')->name('company-change-message-status');
Route::get('/seeker-change-message-status', 'Job\SeekerSendController@change_message_status')->name('seeker-change-message-status');

Route::get('/sitemap', 'SitemapController@index');

Route::get('/sitemap/companies', 'SitemapController@companies');

Route::get('/reports', 'ReportController@showView')->name('reports');
Route::post('/download/reports', 'ReportController@download')->name('download.reports');

Route::get('/gestion-permisos', 'Admin\GestionController@gestionar')->name('gestion-permisos');
Route::post('/save-permissions', 'Admin\GestionController@store')->name('save-permissions');

Route::get('/donwload-statictics-download',  'ExportController@download' )->name('download');

Route::get('/donwload-camara/{company?}',  'Company\CompanyController@download' );
Route::get('/donwload-camara-by-admin/{company?}',  'Admin\CompanyController@download' );
Route::get('/download-cv/{file?}/{title?}/{user}',  function($a, $b, $c){

//   if(Auth::check()){
       
       $res = User::with(['profileCvs' => function($q) use ($b) {
           $q->where('title', $b);
       }])->find($c);
       
       if($res->profileCvs && count($res->profileCvs) > 0){
           return response()->download(public_path() . '/cvs/'.$a);
    //   }
   }
   
});
Route::get('/download-cv-on-candidate/{file?}/{user}/{jobs}',  function($a, $c, $d){
    
    
    

   if(Auth::guard('company')->check()){
       
    $jobs = Job::findOrFail($d);
    
    if($jobs->company_id == Auth::guard('company')->user()->id ){
        
       if(in_array($c, $jobs->getAppliedUserIdsArray() )){
          return response()->download(public_path() . '/cvs/'.$a);
       }
    }
    
   }
   
   abort(404);
   
});


Route::get('donwload-letter/{c?}',  function($a){
    $user = User::findOrFail($a);
    if($user->letter && $user->letter != '') {
          return response()->download(public_path() . '/letters/'.$user->letter);
    }
    return back();
});


Route::post('contratar_emp', 'documento_contratadoController@contrato');
Route::post('rechazar_emp', 'documento_contratadoController@rechazar');
Route::post('entrevistar', 'documento_contratadoController@entrevistar');

Route::get('admin/send-cvs', function(){
    $companies = Company::get(['id', 'name']);
    return view('admin.send-cvs', compact('companies'));
});

Route::get('admin/job-index/{id}', function($id){
    return response()->json(Job::where('company_id', $id)->get(['id', 'title']));
});

Route::get('admin/job-users/{search}', 'Job\JobController@searchStudenByJobs');
Route::get('admin/job-users-send-emails/{data}/{comapny}/{job}', 'Job\JobController@sendEmails');

Route::get('admin/get-xls',  function(){
    return (new Ids)->download('documentos.xlsx');
    });

Route::resource('admin/documento_contratado', 'documento_contratadoController');
Route::resource('admin/documento_pasantias', 'documento_pasantiasController');

Route::get('get-list-trainings', 'Admin\AdminController@listTrainings')->name('get-list-trainings');
Route::get('admin/list/trainings', 'Admin\AdminController@viewlistTrainings')->name('list.trainings');
Route::get('admin/list/participants/{id}', 'Admin\AdminController@viewlistParticipants')->name('list.participants');
Route::get('list/participants-all', 'Admin\AdminController@listParticipants')->name('get-list-participants');
Route::get('list/participants-delete', 'Admin\AdminController@listParticipantsDelete')->name('list.participants-delete');


