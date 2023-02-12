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
         $totalTodaysUsers = User::where('created_at', 'like', $today->toDateString() . '%')->get();
         
        return view('export.staticticsuser', [
            'users' => $totalTodaysUsers
        ]);
    }
}