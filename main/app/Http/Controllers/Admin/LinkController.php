<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use Carbon\Carbon;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Link;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
// use App\Http\Requests\LinkFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class LinkController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLinks()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.link.index')->with('languages', $languages);
    }

    public function createLink()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.link.add')->with('languages', $languages);
    }

    public function storeLink(Request $request)
    {

        $link = new Link();
        $link->text = $request->input('text');
        $link->link = $request->input('link');
        $link->lang = $request->input('lang');
        $link->rol = $request->input('rol');
        $link->save();
        /*         * ************************************ */
        $link->sort_order = $link->id;
        $link->update();
        flash('LINK has been added!')->success();
        return \Redirect::route('edit.link', array($link->id));
    }

    public function editLink($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $link = Link::findOrFail($id);
        return view('admin.link.edit')
            ->with('languages', $languages)
            ->with('link', $link);
    }

    public function updateLink($id, Request $request)
    {
        $link = Link::findOrFail($id);
        $link->text = $request->input('text');
        $link->link = $request->input('link');
        $link->rol = $request->input('rol');
        $link->lang = $request->input('lang');
        $link->update();
        flash('LINK has been updated!')->success();
        return \Redirect::route('edit.link', array($link->id));
    }

    public function deleteLink(Request $request)
    {
        $id = $request->input('id');
        try {
            $link = Link::findOrFail($id);
            $link->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function fetchLinksData(Request $request)
    {
        $links = Link::select(
            [
                'links.id',
                'links.text',
                'links.link',
                'links.sort_order',
                'links.lang',
                'links.created_at',
                'links.updated_at'
            ]
        );
        return Datatables::of($links)
            ->filter(function ($query) use ($request) {
                if ($request->has('text') && !empty($request->text)) {
                    $query->where('links.text', 'like', "%{$request->get('text')}%");
                }
                if ($request->has('lang') && !empty($request->get('lang'))) {
                    $query->where('links.lang', 'like', "%{$request->get('lang')}%");
                }
                if ($request->has('link') && !empty($request->link)) {
                    $query->where('links.text', 'like', "%{$request->get('link')}%");
                }
            })
            ->addColumn('link', function ($links) {
                $link = Str::limit($links->link, 100, '...');
                $direction = MiscHelper::getLangDirection($links->lang);
                return '<span dir="' . $direction . '">' . $link . '</span>';
            })
            ->addColumn('text', function ($links) {
                $text = Str::limit($links->text, 100, '...');
                $direction = MiscHelper::getLangDirection($links->lang);
                return '<span dir="' . $direction . '">' . $text . '</span>';
            })
            ->addColumn('action', function ($links) {
                /*                             * ************************* */
                return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acción
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.link', ['id' => $links->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="delete_link(' . $links->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</a>
						</li>																																							
					</ul>
				</div>';
            })
            ->rawColumns(['link', 'text', 'action'])
            ->setRowId(function ($links) {
                return 'link_dt_row_' . $links->id;
            })
            ->make(true);
    }

    public function sortLinks()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.link.sort')->with('languages', $languages);
    }

    public function linkSortData(Request $request)
    {
        $lang = $request->input('lang');
        $links = Link::select('links.id', 'links.text', 'links.sort_order')
            ->where('links.lang', 'like', $lang)
            ->orderBy('links.sort_order')->get();
        $str = '<ul id="sortable">';
        if ($links != null) {
            foreach ($links as $link) {
                $str .= '<li id="' . $link->id . '"><i class="fa fa-sort"></i>' . $link->text . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function linkSortUpdate(Request $request)
    {
        $linkOrder = $request->input('linkOrder');
        $linkOrderArray = explode(',', $linkOrder);
        $count = 1;
        foreach ($linkOrderArray as $link_id) {
            $link = Link::find($link_id);
            $link->sort_order = $count;
            $link->update();
            $count++;
        }
    }
}
