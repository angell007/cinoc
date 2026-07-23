<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Jrean\UserVerification\Events\UserVerified;

class ActivateVerifiedUser
{
    public function handle(UserVerified $event)
    {
        $user = $event->user;

        if (!isset($user->table) || $user->table !== 'users') {
            return;
        }

        DB::table('users')
            ->where('email', $user->email)
            ->update(['is_active' => 1]);

        flash('Tu cuenta ha sido activada. Ingresa con tu correo electrónico y la contraseña que registraste.')->success();
    }
}
