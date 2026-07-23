<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class UserActiveExport implements FromView
{
    public function view(): View
    {

        $today = Carbon::now();



        $totalTodaysUsers = User::leftjoin('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
        ->where('users.is_active', 1)
        ->select('users.*', 'users.created_at')
        ->distinct('users.id')
        ->get();



        return view('export.staticticsuser', [

            'users' => $totalTodaysUsers

        ]);

    }

}
