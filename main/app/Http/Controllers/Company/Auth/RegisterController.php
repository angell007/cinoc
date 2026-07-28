<?php

namespace App\Http\Controllers\Company\Auth;

use Auth;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\CompanyFrontRegisterFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\CompanyRegistered;
use App\Mail\CompanyRegistrationReceivedMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Subscription;
use ImgUploader;
use Newsletter;

class RegisterController extends Controller
{
    use RegistersUsers;
    use VerifiesUsers;

    protected $redirectTo = '/company-home';
    protected $userTable = 'companies';
    protected $redirectIfVerified = '/company-home';
    protected $redirectAfterVerification = '/company-home';

    public function __construct()
    {
        $this->middleware('company.guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    protected function guard()
    {
        return Auth::guard('company');
    }

    public function register(CompanyFrontRegisterFormRequest $request)
    {
        $company = new Company();
        $company->person_type = $request->input('person_type');
        $company->name = $request->input('name');
        $company->tipo_identificacion = $request->input('tipo_identificacion');
        $company->identificacion = $request->input('identificacion');
        $company->industry_id = $request->input('industry_id');
        $company->ownership_type_id = $request->input('ownership_type_id');
        $company->description = $request->input('description');
        $company->no_of_employees = $request->input('no_of_employees');
        $company->established_in = $request->input('established_in');
        $website = trim((string) $request->input('website'));
        if ($website !== '') {
            $company->website = (false === strpos($website, 'http')) ? 'http://' . $website : $website;
        }
        $company->ceo = $request->input('ceo');
        $company->ceo_email = $request->input('ceo_email');
        $company->tipo_identificacion_ceo = $request->input('tipo_identificacion_ceo');
        $company->identificacion_ceo = $request->input('identificacion_ceo');
        $company->contact_name = $request->input('contact_name');
        $company->phone = $request->input('phone');
        $company->country_id = $request->input('country_id');
        $company->state_id = $request->input('state_id');
        $company->city_id = $request->input('city_id');
        $company->location = $request->input('location');
        $company->facebook = $request->input('facebook');
        $company->twitter = $request->input('twitter');
        $company->linkedin = $request->input('linkedin');
        $company->google_plus = $request->input('google_plus');
        $company->email = $request->input('email');
        $company->password = bcrypt($request->input('password'));
        $company->is_active = 0;
        $company->verified = 0;
        $company->save();

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = ImgUploader::UploadImage('company_logos', $image, $company->name, 300, 300, false);
            $company->logo = $fileName;
        }

        if ($request->hasFile('camara_comercio')) {
            $file = $request->file('camara_comercio');
            $destinationPath = 'uploads';
            $safeName = 'camara-' . $company->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $safeName);
            $company->camara_comercio = $destinationPath . '/' . $safeName;
        }

        $company->slug = Str::slug($company->name, '-') . '-' . $company->id;
        $company->update();

        if ((bool) $request->input('is_subscribed')) {
            $subscription = new Subscription();
            $subscription->email = $company->email;
            $subscription->name = $company->name;
            $subscription->save();
            Newsletter::subscribeOrUpdate($subscription->email, ['FNAME' => $company->name]);
        }

        event(new Registered($company));
        event(new CompanyRegistered($company));

        $this->guard()->login($company);

        UserVerification::generate($company);
        UserVerification::send($company, 'Company Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));

        Mail::send(new CompanyRegistrationReceivedMailable($company));

        $this->guard()->logout();

        flash('Registro exitoso. Hemos enviado un correo confirmando la recepción de su solicitud. Revise también su bandeja de entrada para verificar su correo electrónico. El acceso a la plataforma se habilitará una vez la Bolsa de Empleo valide y active su empresa.')->success();
        return redirect()->back();
    }
}
