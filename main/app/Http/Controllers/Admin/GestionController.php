<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Admin;
use App\Permission;
use App\Job;
use App\JobApply;
use App\Company;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\AdminAuthorizationHelper As APAuthHelp;

use Illuminate\Support\Facades\Auth;

class GestionController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    
    public function gestionar()
    {

          $permissions = Permission::where('state', 'Activo')->get();
          $misPermissions = APAuthHelp::getAdminPermission(request()->get('id', Auth::guard('admin')->user()->id ));
          $id = request()->get('id', Auth::guard('admin')->user()->id );
           return view('admin.gestion.gestion', compact('permissions','misPermissions', 'id'));
    }
    
    
    public function store()
    {
         $user = Admin::find(request()->get('id'));
        
        // $user = Auth::guard('admin')->user();
        
        $user->permissions()->sync(array_keys(request()->get('permisos')));
        
        return back();
        
    }

   
}
