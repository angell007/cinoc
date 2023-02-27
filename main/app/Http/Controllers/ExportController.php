<?php



namespace App\Http\Controllers;



use App\Exports\UserTodayExport;

use App\Exports\UserActiveExport;

use App\Exports\UserVerifiedExport;

use App\Exports\VacancyTodayExport;

use App\Exports\VacancyActiveExport;

use App\Exports\VacancyInactiveExport;

use App\Exports\VacancyApplyExport;

use App\Exports\VacancyContractExport;

use App\Exports\CompanysExport;

use Illuminate\Http\Request;





use Illuminate\Support\Facades\Session;



use Maatwebsite\Excel\Facades\Excel;



class ExportController extends Controller

{

    public function download()

    {

        try {



            switch (request()->get('type')) {

                case 1:

                    return Excel::download(new UserTodayExport, 'usuarios_hoy.xlsx');

                    break;

                case 2:

                    return Excel::download(new UserActiveExport, 'usuarios_activos.xlsx');

                    break;

                case 3:

                    return Excel::download(new UserVerifiedExport, 'usersToday.xlsx');

                    break;

                case 4:

                    return Excel::download(new CompanysExport, 'empresas.xlsx');

                    break;

                case 5:

                    return Excel::download(new VacancyTodayExport, 'vacantes_hoy.xlsx');

                    break;

                case 6:

                    return Excel::download(new VacancyActiveExport, 'vacantes_activas.xlsx');

                    break;

                case 7:

                    return Excel::download(new VacancyInactiveExport, 'vacantes_inactivas.xlsx');

                    break;

                case 8:

                    return Excel::download(new VacancyApplyExport, 'vacantes_aplicadas.xlsx');

                    break;

                case 9:

                    return Excel::download(new VacancyContractExport, 'contratados.xlsx');

                    break;

                case 11:

                    return Excel::download(new VacancyContractExport, 'contratados.xlsx');

                    break;
            }

            // return back();

        } catch (\Throwable $th) {

            return $th->getMessage();
        }
    }
}
