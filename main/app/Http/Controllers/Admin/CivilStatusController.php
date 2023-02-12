<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use Redirect;
use App\Language;
use App\CivilStatus;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\CivilStatusFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CivilStatusController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexCivilStatuses()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.civil_status.index')->with('languages', $languages);
    }

    public function createCivilStatus()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $civilStatuses = DataArrayHelper::defaultCivilStatusesArray();
        return view('admin.civil_status.add')
            ->with('languages', $languages)
            ->with('civilStatuses', $civilStatuses);
    }

    public function storeCivilStatus(CivilStatusFormRequest $request)
    {
        $civilStatus = new CivilStatus();
        $civilStatus->lang = $request->input('lang');
        $civilStatus->civil_status = $request->input('civil_status');
        $civilStatus->is_default = $request->input('is_default');
        $civilStatus->civil_status_id = $request->input('civil_status_id');
        $civilStatus->is_active = $request->input('is_active');
        $civilStatus->save();
        /*         * ************************************ */
        $civilStatus->sort_order = $civilStatus->id;
        if ((int) $request->input('is_default') == 1) {
            $civilStatus->civil_status_id = $civilStatus->id;
        } else {
            $civilStatus->civil_status_id = $request->input('civil_status_id');
        }
        $civilStatus->update();
        /*         * ************************************ */
        flash('Civil Status has been added!')->success();
        return \Redirect::route('edit.civil.status', array($civilStatus->id));
    }

    public function editCivilStatus($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $civilStatuses = DataArrayHelper::defaultCivilStatusesArray();
        $civilStatus = CivilStatus::findOrFail($id);
        return view('admin.civil_status.edit')
            ->with('languages', $languages)
            ->with('civilStatuses', $civilStatuses)
            ->with('civilStatus', $civilStatus);
    }

    public function updateCivilStatus($id, CivilStatusFormRequest $request)
    {
        $civilStatus = CivilStatus::findOrFail($id);
        $civilStatus->lang = $request->input('lang');
        $civilStatus->civil_status = $request->input('civil_status');
        $civilStatus->is_default = $request->input('is_default');
        $civilStatus->civil_status_id = $request->input('civil_status_id');
        $civilStatus->is_active = $request->input('is_active');
        /*         * ************************************ */
        if ((int) $request->input('is_default') == 1) {
            $civilStatus->civil_status_id = $civilStatus->id;
        } else {
            $civilStatus->civil_status_id = $request->input('civil_status_id');
        }
        /*         * ************************************ */
        $civilStatus->update();
        flash('Civil Status has been updated!')->success();
        return \Redirect::route('edit.civil.status', array($civilStatus->id));
    }

    public function deleteCivilStatus(Request $request)
    {
        $id = $request->input('id');
        try {
            $civilStatus = CivilStatus::findOrFail($id);
            if ((bool) $civilStatus->is_default) {
                CivilStatus::where('civil_status_id', '=', $civilStatus->civil_status_id)->delete();
            } else {
                $civilStatus->delete();
            }
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function fetchCivilStatusesData(Request $request)
    {
        $civilStatuses = CivilStatus::select([
            'civil_statuses.id', 'civil_statuses.lang', 'civil_statuses.civil_status', 'civil_statuses.is_default', 'civil_statuses.civil_status_id', 'civil_statuses.is_active',
        ])->sorted();
        return Datatables::of($civilStatuses)
            ->filter(function ($query) use ($request) {
                if ($request->has('lang') && !empty($request->lang)) {
                    $query->where('civil_statuses.lang', 'like', "{$request->get('lang')}");
                }
                if ($request->has('civil_status') && !empty($request->civil_status)) {
                    $query->where('civil_statuses.civil_status', 'like', "%{$request->get('civil_status')}%");
                }
                if ($request->has('is_active') && $request->is_active != -1) {
                    $query->where('civil_statuses.is_active', '=', "{$request->get('is_active')}");
                }
            })
            ->addColumn('civil_status', function ($civilStatuses) {
                $civilStatus = Str::limit($civilStatuses->civil_status, 100, '...');
                $direction = MiscHelper::getLangDirection($civilStatuses->lang);
                return '<span dir="' . $direction . '">' . $civilStatus . '</span>';
            })
            ->addColumn('action', function ($civilStatuses) {
                /*                             * ************************* */
                $activeTxt = 'Activar';
                $activeHref = 'makeActive(' . $civilStatuses->id . ');';
                $activeIcon = 'square-o';
                if ((int) $civilStatuses->is_active == 1) {
                    $activeTxt = 'Inactivar';
                    $activeHref = 'makeNotActive(' . $civilStatuses->id . ');';
                    $activeIcon = 'check-square-o';
                }
                return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acción
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.civil.status', ['id' => $civilStatuses->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteCivilStatus(' . $civilStatuses->id . ', ' . $civilStatuses->is_default . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</a>
						</li>
						<li>
						<a href="javascript:void(0);" onClick="' . $activeHref . '" id="onclickActive' . $civilStatuses->id . '"><i class="fa fa-' . $activeIcon . '" aria-hidden="true"></i>' . $activeTxt . '</a>
						</li>																																		
					</ul>
				</div>';
            })
            ->rawColumns(['action', 'civil_status'])
            ->setRowId(function ($civilStatuses) {
                return 'civilStatusDtRow' . $civilStatuses->id;
            })
            ->make(true);
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    public function makeActiveCivilStatus(Request $request)
    {
        $id = $request->input('id');
        try {
            $civilStatus = CivilStatus::findOrFail($id);
            $civilStatus->is_active = 1;
            $civilStatus->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveCivilStatus(Request $request)
    {
        $id = $request->input('id');
        try {
            $civilStatus = CivilStatus::findOrFail($id);
            $civilStatus->is_active = 0;
            $civilStatus->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortCivilStatuses()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.civil_status.sort')->with('languages', $languages);
    }

    public function civilStatusSortData(Request $request)
    {
        $lang = $request->input('lang');
        $civilStatuses = CivilStatus::select('civil_statuses.id', 'civil_statuses.civil_status', 'civil_statuses.sort_order')
            ->where('civil_statuses.lang', 'like', $lang)
            ->orderBy('civil_statuses.sort_order')
            ->get();
        $str = '<ul id="sortable">';
        if ($civilStatuses != null) {
            foreach ($civilStatuses as $civilStatus) {
                $str .= '<li id="' . $civilStatus->id . '"><i class="fa fa-sort"></i>' . $civilStatus->civil_status . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function civilStatusSortUpdate(Request $request)
    {
        $civilStatusOrder = $request->input('civilStatusOrder');
        $civilStatusOrderArray = explode(',', $civilStatusOrder);
        $count = 1;
        foreach ($civilStatusOrderArray as $civilStatusId) {
            $civilStatus = CivilStatus::find($civilStatusId);
            $civilStatus->sort_order = $count;
            $civilStatus->update();
            $count++;
        }
    }
}
