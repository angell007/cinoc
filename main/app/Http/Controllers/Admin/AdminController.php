<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Role;
use App\Http\Requests\AdminFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Exports\DatosExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
    }
    public function indexAdminUsers()
    {
        return view('admin.admin.index');
    }
    public function datosexport(request $request)
    {
        try {
            return Excel::download(new DatosExport($request->a, $request->b), 'datos.xlsx');
        } catch (\Exception $e) {
            return back();
        }
    }
    public function createAdminUser()
    {
        $roles = Role::select('role_name', 'id')->orderBy('role_name')->pluck('role_name', 'id')->toArray();
        return view('admin.admin.create')->with('roles', $roles);
    }
    public function storeAdminUser(AdminFormRequest $request)
    {
        $user = new Admin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        Mail::send('admin.admin.emails.new_admin_user_created', ['user' => $user], function ($msg) use ($user) {
            $msg->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
            $msg->to($user->email, $user->name)->subject('Please set your password to ' . config('app.name') . ' admin panel.');
        });
        flash('New Admin User has been created!')->success();
        return Redirect::route('edit.admin.user', array($user->id));
    }
    public function editAdminUser($id)
    {
        $user = Admin::findOrFail($id);
        $roles = Role::select('role_name', 'id')->orderBy('role_name')->pluck('role_name', 'id')->toArray();
        return view('admin.admin.edit')->with('roles', $roles)->with('user', $user);
    }
    public function updateAdminUser($id, AdminFormRequest $request)
    {
        $user = Admin::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->save();
        flash('Admin User has been updated!')->success();
        return Redirect::route('edit.admin.user', array($user->id));
    }
    public function deleteAdminUser(Request $request)
    {
        if ($this->notCurrentUser($request->get('id'))) {
            $id = $request->input('id');
            try {
                $user = Admin::findOrFail($id);
                $user->delete();
                return 'ok';
            } catch (ModelNotFoundException $e) {
                return 'notok';
            }
        }
        return 'sameUser';
    }
    public function deleteAdminDocument(Request $request)
    {
        if ($this->notCurrentUser($request->get('id'))) {
            $id = $request->input('id');
            try {
                DB::table('idcards_numbers')->where('id', $request->get('id'))->delete();
                return 'ok';
            } catch (ModelNotFoundException $e) {
                return 'notok';
            }
        }
        return 'sameUser';
    }
    public function fetchAdminUsersData()
    {
        $users = Admin::join('roles', 'admins.role_id', '=', 'roles.id')->select('admins.id', 'admins.name', 'admins.email', 'roles.role_name');
        return DataTables::of($users)->addColumn('action', function ($user) {
            return '
                    <a href="' . route('edit.admin.user', ['id' => $user->id]) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit">
                    </i> Edit
                    </a>
                    <a href="' . route('gestion-permisos', ['id' => $user->id]) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-plus">
                    </i> Gestión Permisos 
                    </a>
                    <a href="javascript:void(0);" onclick="delete_user(' . $user->id . ');" class="btn btn-xs btn-danger">
                    <i class="glyphicon glyphicon-remove">
                    </i> Delete
                    </a>';
        })->removeColumn('password')->setRowId(function ($user) {
            return 'admin_user_dt_row_' . $user->id;
        })->make(true);
    }
    public function notCurrentUser($id)
    {
        if (Auth::user()->id == (int)$id) {
            return false;
        }
        return true;
    }
    public function viewlistTrainings()
    {
        return view('admin.trainings.index');
    }
    public function viewlistUsers()
    {
        return view('admin.trainings.users');
    }
    public function viewlistCompanies()
    {
        return view('admin.trainings.companies');
    }
    public function viewlistParticipants($id)
    {
        return view('admin.trainings.participants', compact('id'));
    }
    public function viewlistParticipantsCompanies($id)
    {
        return view('admin.trainings.participants_companies', compact('id'));
    }
    public function listTrainingsUsers()
    {
        $trainings = DB::table('trainings')->where('to', 'Empresas')->select('*');
        return Datatables::of($trainings)->addColumn('action', function ($trainings) {
            return '
                    <a href="' . route('list.participants', ['id' => $trainings->id]) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit">
                    </i> Detalle 
                    </a>' . '
                    <a href="javascript:void(0);" onclick="delete_training(' . $trainings->id . ');" class="btn btn-xs btn-danger">
                    <i class="glyphicon glyphicon-remove">
                    </i> Delete
                    </a';
        })->make(true);
    }
    public function listTrainingsComapnies()
    {
        $trainings = DB::table('trainings')->where('to', 'Empresas')->select('*');
        return Datatables::of($trainings)->addColumn('action', function ($trainings) {
            return '
                    <a href="' . route('list.participants.companies', ['id' => $trainings->id]) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit">
                    </i> Detalle 
                    </a>' . '
                    <a href="javascript:void(0);" onclick="delete_training(' . $trainings->id . ');" class="btn btn-xs btn-danger">
                    <i class="glyphicon glyphicon-remove">
                    </i> Delete
                    </a';
        })->make(true);
    }
    public function listParticipants()
    {
        $participants = DB::table('participants')->select('*')->where('trainings_id', request()->get('id'));
        return Datatables::of($participants)->addColumn('action', function ($participant) {
            return '
                    <a href="' . route('list.participants-delete', ['id' => $participant->id]) . '" class="btn btn-xs btn-danger">
                    <i class="glyphicon glyphicon-trash">
                    </i> Eliminar 
                    </a>';
        })->make(true);
    }
    public function listParticipantsDelete()
    {
        DB::table('participants')->delete(request()->get('data'));
        DB::table('trainings')->delete(request()->get('data'));
        return back();
    }
}
