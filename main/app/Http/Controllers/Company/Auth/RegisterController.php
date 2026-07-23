<?php

namespace App\Http\Controllers\Company\Auth;

use Auth;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
use Newsletter;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/company-home';
    protected $userTable = 'companies';
    protected $redirectIfVerified = '/company-home';
    protected $redirectAfterVerification = '/company-home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company.guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('company');
    }

    public function register(CompanyFrontRegisterFormRequest $request)
    {
        
        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->password = bcrypt($request->input('password'));
        $company->is_active = 0;
        $company->verified = 0;
        $company->save();
        /*         * ******************** */
        $company->slug = Str::slug($company->name, '-') . '-' . $company->id;
        $company->update();
        /*         * ******************** */
        
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

        // return $this->registered($request, $company) ?: redirect($this->redirectPath());
    }

}
