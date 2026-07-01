<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class UserTodayExport implements FromView
{
    public function view(): View
    {
        $today = Carbon::now();
        $totalTodaysUsers = User::join('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
            ->where('created_at', 'like', $today->toDateString() . '%')
            ->distinct('users.id')
            ->get();
        return view('export.staticticsuser', ['users' => $totalTodaysUsers]);
    }
}
