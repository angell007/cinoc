<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobApply;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    { //
        $this->middleware('auth');
    }
    public function index()
    {
        $today = Carbon::now();
        $totalActiveUsers = User::where('is_active', 1)->count();
        $totalVerifiedUsers = User::where('verified', 1)->count();
        $totalTodaysUsers = User::where('created_at', 'like', $today->toDateString() . '%')->count();
        $recentUsers = User::orderBy('id', 'DESC')->take(25)->get();
        $totalActiveJobs = Job::where('is_active', 1)->count();
        $totalFeaturedJobs = Job::where('is_featured', 1)->count();
        $totalTodaysJobs = Job::where('created_at', 'like', $today->toDateString() . '%')->count();

        $culminados = DB::table('participants')
            ->join('trainings', 'participants.trainings_id', 'trainings.id')
            ->where('trainings.to', 'Oferentes')
            ->where('status', 'Culminó')
            ->whereMonth('participants.updated_at', Carbon::now()->month)->count();

        $asistieron = DB::table('participants')
            ->join('trainings', 'participants.trainings_id', 'trainings.id')
            ->where('trainings.to', 'Oferentes')
            ->where('status', 'Asistió')
            ->whereMonth('participants.updated_at', Carbon::now()->month)->count();

        $direccionados = DB::table('participants')
            ->join('trainings', 'participants.trainings_id', 'trainings.id')
            ->where('trainings.to', 'Oferentes')
            ->where('status', 'Direccionado')
            ->whereMonth('participants.updated_at', Carbon::now()->month)->count();

        $advisorycv = DB::table('advisory')
            ->whereMonth('advisory.created_at', '=', $today->month)
            ->join('users', 'users.id', 'advisory.user_id')
            ->count();

        $totalcvs = User::where('is_active', 1)->join('profile_cvs as pcv', 'pcv.user_id', 'users.id')->get();
        $recentJobs = Job::orderBy('id', 'DESC')->take(25)->get();
        $OfertaLaboral = JobApply::count();
        $totalCompany = Company::count();
        $contratado = JobApply::where("status", "=", "contratado")->count();

        return view('admin.home')
            ->with('totalActiveUsers', $totalActiveUsers)
            ->with('totalVerifiedUsers', $totalVerifiedUsers)
            ->with('totalTodaysUsers', $totalTodaysUsers)
            ->with('recentUsers', $recentUsers)
            ->with('totalActiveJobs', $totalActiveJobs)
            ->with('totalFeaturedJobs', $totalFeaturedJobs)
            ->with('totalTodaysJobs', $totalTodaysJobs)
            ->with('OfertaLaboral', $OfertaLaboral)
            ->with('totalCompany', $totalCompany)
            ->with('contratado', $contratado)
            ->with('recentJobs', $recentJobs)
            ->with('culminados',  $culminados)
            ->with('asistieron',  $asistieron)
            ->with('direccionados',  $direccionados)
            ->with('advisorycv',  $advisorycv)
            ->with('totalcvs', $totalcvs->count());
    }
}
