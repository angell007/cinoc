<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use App\Models\IdcardsNumber;
use Newsletter;
use App\Subscription;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function register(UserFrontRegisterFormRequest $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        
        $user->first_lastname = $request->input('first_lastname', '');
        $user->second_lastname = $request->input('second_lastname', '');
         
        $user->rol = $request->input('rol', 'Estudiante');
        $user->email = $request->input('email');
        $user->national_id_card_number = $request->input('national_id_card_number');
        $user->password = bcrypt($request->input('password'));
        
        // $user->is_active = 1;
        // $user->verified = 1;
        
        // dd($user);
        
        $user->saveOrFail();
        
         	if((bool)$request->input('is_subscribed'))
		{		
		    
		   
			$subscription = new Subscription();
			$subscription->email = $user->email;
			$subscription->name = $user->name;
			$subscription->save();
			
			/*************************/
			Newsletter::subscribeOrUpdate($subscription->email, ['FNAME'=>$subscription->name]) ;
			/*************************/
		}
		else
		{
		   
			/*************************/
			Newsletter::unsubscribe($user->email);
			/*************************/
		}
		
        
        $idNumber = IdcardsNumber::firstWhere('id_number', $user->national_id_card_number);
        $idNumber->delete();
        
        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        /*         * *********************** */
        event(new Registered($user));
        event(new UserRegistered($user));
        $this->guard()->login($user);
        // UserVerification::generate($user);
        // UserVerification::send($user, 'User Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));
        // flash('Felicitaciones')->success();
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

   
}
