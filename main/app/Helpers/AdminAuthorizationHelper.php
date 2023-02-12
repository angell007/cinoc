<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use App\Admin;

class AdminAuthorizationHelper
{

    public static function check($allowed_roles = ['SUP_ADM'])
    {
        if (null === Auth::guard('admin')->user()) {
            return false;
        }
        $user = Auth::guard('admin')->user();
        $userRole = $user->getAdminUserRole();
        return in_array($userRole->role_abbreviation, $allowed_roles) ? true : false;
    }
    
     public static function getAdminPermission($id = null)
    {
        $user = ($id == null ) ? Auth::guard('admin')->user() : Admin::Find($id);
        $user->load('permissions');
        return $user->permissions()->pluck('permissions.name')->toArray();
    }
    
    public static function hasPermission($permission)
    {
        $mypermissions = self::getAdminPermission();
        return (in_array($permission, $mypermissions)) ? true : false;
    }

}
