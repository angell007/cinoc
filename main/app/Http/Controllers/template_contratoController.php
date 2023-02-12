<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\template_contrato;
use App\User;
use Illuminate\Http\Request;

class template_contratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $templates = template_contrato::all();
        $companies = Company::all();
        $users = User::all();

        if (!empty($keyword)) {
            $template_contrato = template_contrato::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('html', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $template_contrato = template_contrato::latest()->paginate($perPage);
        }

        return view('admin.template_contrato.index', compact('template_contrato', 'templates', 'companies', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.template_contrato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        template_contrato::create($requestData);

        return redirect('admin/template_contrato')->with('flash_message', 'template_contrato added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $template_contrato = template_contrato::findOrFail($id);

        return view('admin.template_contrato.show', compact('template_contrato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $template_contrato = template_contrato::findOrFail($id);

        return view('admin.template_contrato.edit', compact('template_contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $template_contrato = template_contrato::findOrFail($id);
        $template_contrato->update($requestData);

        return redirect('admin/template_contrato')->with('flash_message', 'template_contrato updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        template_contrato::destroy($id);

        return redirect('admin/template_contrato')->with('flash_message', 'template_contrato deleted!');
    }
}
