<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCronToken
{
    /**
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $expectedToken = env('CRON_TOKEN');

        if (empty($expectedToken) || $request->route('token') !== $expectedToken) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
