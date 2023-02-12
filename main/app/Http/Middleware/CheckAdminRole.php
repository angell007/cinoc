<?php

namespace App\Http\Middleware;
use App\Helpers\AdminAuthorizationHelper As APAuthHelp;


use Closure;

class CheckAdminRole
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if ($request->user()->hasRole($roles) || !$roles) {
            
        //   dd( $request->route() );
            // if(APAuthHelp::hasPermission('company')){
                 return $next($request);
            // }
            
        }
        
        // return abort(404);
        
        return response()->view('admin.errors.401', [], 401);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['allowed_roles']) ? $actions['allowed_roles'] : null;
    }

}
