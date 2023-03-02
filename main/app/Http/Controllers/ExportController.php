<?php

namespace App\Http\Controllers;

use App\Exports\AdvisorycvExport;
use App\Exports\UserTodayExport;
use App\Exports\UserActiveExport;
use App\Exports\UserVerifiedExport;
use App\Exports\VacancyTodayExport;
use App\Exports\VacancyActiveExport;
use App\Exports\VacancyInactiveExport;
use App\Exports\VacancyApplyExport;
use App\Exports\VacancyContractExport;
use App\Exports\CompanysExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function download()
    {
        try {
            switch (request()->get('type')) {
                case 1:
                    return Excel::download(new UserTodayExport, 'usuarios_hoy.xlsx');
                case 2:
                    return Excel::download(new UserActiveExport, 'usuarios_activos.xlsx');
                case 3:
                    return Excel::download(new UserVerifiedExport, 'usersToday.xlsx');
                case 4:
                    return Excel::download(new CompanysExport, 'empresas.xlsx');
                case 5:
                    return Excel::download(new VacancyTodayExport, 'vacantes_hoy.xlsx');
                case 6:
                    return Excel::download(new VacancyActiveExport, 'vacantes_activas.xlsx');
                case 7:
                    return Excel::download(new VacancyInactiveExport, 'vacantes_inactivas.xlsx');
                case 8:
                    return Excel::download(new VacancyApplyExport, 'vacantes_aplicadas.xlsx');
                case 9:
                    return Excel::download(new VacancyContractExport, 'contratados.xlsx');
                case 11:
                    return Excel::download(new VacancyContractExport, 'contratados.xlsx');
                case 12:
                    return Excel::download(new AdvisorycvExport, 'asesorias_cv.xlsx');
            }
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
