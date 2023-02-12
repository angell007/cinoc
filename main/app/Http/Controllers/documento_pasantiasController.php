<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\documento_pasantia;
use Illuminate\Http\Request;

class documento_pasantiasController extends Controller
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

        if (!empty($keyword)) {
            $documento_pasantias = documento_pasantia::where('id_empresa', 'LIKE', "%$keyword%")
                ->orWhere('id_candidato', 'LIKE', "%$keyword%")
                ->orWhere('fecha', 'LIKE', "%$keyword%")
                ->orWhere('notas', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $documento_pasantias = documento_pasantia::latest()->paginate($perPage);
        }

        return view('admin.documento_pasantias.index', compact('documento_pasantias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.documento_pasantias.create');
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
        
        documento_pasantia::create($requestData);

        return redirect('admin/documento_pasantias')->with('flash_message', 'documento_pasantia added!');
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
        $documento_pasantia = documento_pasantia::findOrFail($id);

        return view('admin.documento_pasantias.show', compact('documento_pasantia'));
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
        $documento_pasantia = documento_pasantia::findOrFail($id);

        return view('admin.documento_pasantias.edit', compact('documento_pasantia'));
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
        
        $documento_pasantia = documento_pasantia::findOrFail($id);
        $documento_pasantia->update($requestData);

        return redirect('admin/documento_pasantias')->with('flash_message', 'documento_pasantia updated!');
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
        documento_pasantia::destroy($id);

        return redirect('admin/documento_pasantias')->with('flash_message', 'documento_pasantia deleted!');
    }
}
