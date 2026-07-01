<?php

namespace App\Exports;

use App\JobApply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdvisorycvExport implements FromView
{
    public function view(): View
    {
        $subquery = DB::table('profile_educations as pe')
            ->select('pe.user_id', 'pe.degree_result')
            ->groupBy('pe.user_id'); 

        if (request()->get('inicio')) {
            $users = DB::table('advisory')
            ->select([
               'users.id',
            'users.name',
            'users.national_id_card_number',
            'users.email',
            'functional_areas.functional_area as functional_area',
            'users.mobile_num',
            'users.rol',
            'states.state as state',
            'cities.city as city',
            'users.street_address',
            'genders.gender as gender',
            'profile_educations.degree_result',
            'marital_statuses.marital_status as marital_status',
            'advisory.created_at as created_at'
            ])
                ->whereBetween('advisory.created_at', [request()->get('inicio'), request()->get('fin')])
                ->join('users', 'users.id', '=', 'advisory.user_id')
                ->join('functional_areas', 'functional_areas.functional_area_id', '=', 'users.functional_area_id')
                ->leftJoinSub($subquery, 'profile_educations', function ($join) {
                    $join->on('profile_educations.user_id', '=', 'users.id');
                })
                ->leftJoin('states', 'states.id', '=', 'users.state_id')
                ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                ->leftJoin('genders', 'genders.id', '=', 'users.gender_id')
                ->leftJoin('marital_statuses', 'marital_statuses.id', '=', 'users.marital_status_id')
                ->groupBy('users.id')
                ->get();
            return view('export.advisorycv', [
                'users' => $users->unique()
            ]);
        }
        
        $users = DB::table('advisory')
        ->select([
            'users.id',
            'users.name',
            'users.national_id_card_number',
            'users.email',
            'functional_areas.functional_area as functional_area',
            'users.mobile_num',
            'users.rol',
            'states.state as state',
            'cities.city as city',
            'users.street_address',
            'genders.gender as gender',
            'profile_educations.degree_result',
            'marital_statuses.marital_status as marital_status',
            'advisory.created_at as created_at'
        ])
        ->join('users', 'users.id', '=', 'advisory.user_id')
        ->join('functional_areas', 'functional_areas.functional_area_id', '=', 'users.functional_area_id')
        ->leftJoinSub($subquery, 'profile_educations', function ($join) {
            $join->on('profile_educations.user_id', '=', 'users.id');
        })
        ->leftJoin('states', 'states.id', '=', 'users.state_id')
        ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
        ->leftJoin('genders', 'genders.id', '=', 'users.gender_id')
        ->leftJoin('marital_statuses', 'marital_statuses.id', '=', 'users.marital_status_id')
        ->groupBy('users.id')
        ->get();
        
        // $users = DB::table('advisory')
        //     ->join('users', 'users.id', 'advisory.user_id')
        //     ->join('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
        //     ->join('profile_educations', 'profile_educations.user_id', 'users.id')
        //     ->leftJoin('states', 'states.id', 'users.state_id')
        //     ->leftJoin('cities', 'cities.id', 'users.city_id')
        //     ->leftJoin('genders', 'genders.id', 'users.gender_id')
        //     ->leftJoin('marital_statuses', 'marital_statuses.id', 'users.marital_status_id')
        //     ->distinct('advisory.user_id')
        //     ->get();
        return view('export.advisorycv', [
            'users' => $users->unique()
        ]);
    }
}
