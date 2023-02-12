<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class UserVerifiedExport implements FromView
{
    public function view(): View
    {
         $today = Carbon::now();
         
         $totalTodaysUsers = User::where('verified', 1)->get();
         
        return view('export.staticticsuser', [
            'users' => $totalTodaysUsers
        ]);
    }
}