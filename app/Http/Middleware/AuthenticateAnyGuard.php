<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAnyGuard
{
    /**
     * Permite la petición solo si hay sesión activa (usuario, admin o empresa).
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hasActiveSession = Auth::guard('web')->check()
            || Auth::guard('admin')->check()
            || Auth::guard('company')->check();

        if (!$hasActiveSession) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
