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
    use RegistersUsers;
    use VerifiesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function register(UserFrontRegisterFormRequest $request)
    {
        $user = $this->createUser($request);
        $this->handleSubscription($request, $user);
        $this->deleteIdCardNumber($user);
        $this->updateUserName($user);

        event(new Registered($user));
        event(new UserRegistered($user));

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    private function createUser(UserFrontRegisterFormRequest $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->first_lastname = $request->input('first_lastname', '');
        $user->second_lastname = $request->input('second_lastname', '');
        $user->rol = $request->input('rol');
        $user->email = $request->input('email');
        $user->national_id_card_number = $request->input('national_id_card_number');
        $user->password = bcrypt($request->input('password'));

        $user->saveOrFail();

        return $user;
    }

    private function handleSubscription(UserFrontRegisterFormRequest $request, User $user)
    {
        if ((bool)$request->input('is_subscribed')) {
            $subscription = new Subscription();
            $subscription->email = $user->email;
            $subscription->name = $user->name;
            $subscription->save();

            Newsletter::subscribeOrUpdate($subscription->email, ['FNAME' => $subscription->name]);
        } else {
            Newsletter::unsubscribe($user->email);
        }
    }

    private function deleteIdCardNumber(User $user)
    {
        $idNumber = IdcardsNumber::firstWhere('id_number', $user->national_id_card_number);
        $idNumber->delete();
    }

    private function updateUserName(User $user)
    {
        $user->name = $user->getName();
        $user->update();
    }
}
