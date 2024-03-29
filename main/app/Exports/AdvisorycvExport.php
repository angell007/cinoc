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
        $today = Carbon::now();
        if (request()->get('inicio')) {
            $users = DB::table('advisory')
                ->whereBetween('advisory.created_at', [request()->get('inicio'), request()->get('fin')])
                ->join('users', 'users.id', 'advisory.user_id')
                ->join('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
                ->distinct('users.id')
                ->get();
            return view('export.staticticsuser', [
                'users' => $users->unique()
            ]);
        }
        $users = DB::table('advisory')
            ->whereMonth('advisory.created_at', '=', $today->month)
            ->join('users', 'users.id', 'advisory.user_id')
            ->join('functional_areas', 'functional_areas.functional_area_id', 'users.functional_area_id')
            ->distinct('advisory.user_id')
            ->get();
            
        return view('export.staticticsuser', [
            'users' => $users->unique()
        ]);
    }
}
