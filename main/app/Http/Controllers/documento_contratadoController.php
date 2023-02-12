<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\documento_contratado;
use App\Company;
use App\Job;
use Illuminate\Http\Request;
use App\JobApply;
use App\User;
use Mail;
use DB;


class documento_contratadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */


public function contrato(Request $request){

    $requestData = $request->all();

        $user = User::find($request->get('id_candidato'));
        $subject = "Estado de la vacante aplicada";
        $for = $user->email;
        Mail::send('emails.contratado', [], function($msj) use($subject,$for){
            $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            $msj->subject($subject);
            $msj->to($for);
        });


            $company = Company::find($request->get('id_empresa'));
            $jobappply = JobApply::find($request->get('id_job'));
            $job = Job::find($jobappply->job_id);
            $email = DB::table('site_settings')->first();
            
            $subject = "Estado de la vacante aplicada";
            $for = $email->mail_from_address;
            
            Mail::send('emails.alertabyadmin', ['company' => $company, 'user' => $user, 'job' => $job, 'estado' => 'Contratado'], function($msj) use($subject,$for){
    
                $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
                $msj->subject($subject);
                $msj->to($for);
            
            });
            
            
    documento_contratado::create($requestData);

    $mm = JobApply::findOrFail($request->id_job);
    $mm->status="contratado";
    $mm->save();

    return $request->id_job;

}



public function rechazar(Request $request){

    
            $mm = JobApply::findOrFail($request->id_job);
            $job = Job::find($mm->job_id);
            $user = User::find($mm->user_id);
            $company = Company::find($job->company_id);


            $email = DB::table('site_settings')->first();
            
            $subject = "Estado de la vacante aplicada";
            $for = $user->email;
            Mail::send('emails.rechazado', [], function($msj) use($subject,$for){
            $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            $msj->subject($subject);
            $msj->to($for);
        });

        $mm->status="rechazado";
        $mm->save();
        
        
            $for = $email->mail_from_address;
            
            // $for = 'mdgrisalez@misena.edu.co';
            Mail::send('emails.alertabyadmin', ['company' => $company, 'user' => $user, 'job' => $job, 'estado' => 'Rechazado'], function($msj) use($subject,$for){
            $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            $msj->subject($subject);
            $msj->to($for);

            });

    return $request->id_job;

}


public function entrevistar(Request $request){


            $mm = JobApply::findOrFail($request->id_job);
            $job = Job::find($mm->job_id);
            $user = User::find($mm->user_id);
            $company = Company::find($job->company_id);


            $email = DB::table('site_settings')->first();
            
            $subject = "Estado de la vacante aplicada";
            $for = $user->email;
            // $for = 'mdgrisalez@misena.edu.co';
            $for = $user->email;
            Mail::send('emails.entrevista', [], function($msj) use($subject,$for){
            $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            $msj->subject($subject);
            $msj->to($for);
        });

        $mm->status="entrevista";
        $mm->save();
        
        
            $for = $email->mail_from_address;
            // $for = 'mdgrisalez@misena.edu.co';
            
            Mail::send('emails.alertabyadmin', ['company' => $company, 'user' => $user, 'job' => $job, 'estado' => 'Entrevista'], function($msj) use($subject,$for){
            $msj->from("bolsadeempleo@iescinoc.edu.co","IES CINOC");
            $msj->subject($subject);
            $msj->to($for);
            });

    return $request->id_job;

}



    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $documento_contratado = documento_contratado::whereHas('candidate')->whereHas('company')->where('id_empresa', 'LIKE', "%$keyword%")
                ->orWhere('id_candidato', 'LIKE', "%$keyword%")
                ->orWhere('fecha', 'LIKE', "%$keyword%")
                ->orWhere('notas', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $documento_contratado = documento_contratado::whereHas('company')->whereHas('candidate')->latest()->paginate($perPage);
        }
        
        // dd( $documento_contratado);

        return view('admin.documento_contratado.index', compact('documento_contratado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.documento_contratado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        documento_contratado::create($requestData);

        return redirect('admin/documento_contratado')->with('flash_message', 'documento_contratado added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $documento_contratado = documento_contratado::findOrFail($id);

        return view('admin.documento_contratado.show', compact('documento_contratado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $documento_contratado = documento_contratado::findOrFail($id);

        return view('admin.documento_contratado.edit', compact('documento_contratado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $documento_contratado = documento_contratado::findOrFail($id);
        $documento_contratado->update($requestData);

        return redirect('admin/documento_contratado')->with('flash_message', 'documento_contratado updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        documento_contratado::destroy($id);

        return redirect('admin/documento_contratado')->with('flash_message', 'documento_contratado deleted!');
    }
}
