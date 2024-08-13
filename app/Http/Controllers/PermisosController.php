<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('ver permisos')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los permisos.');
        }
        try {
            $permisos = Permission::all();

            $data = [
                'permisos' => $permisos,
            ];

        return view('permisos.index', $data);
    } catch (\Exception $e) {
        return back()->withError($e->getMessage());
    }
    }
    public function create()
    {
        return view('permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $data = new Permission();
        $data->name = $request->name;
        $data->guard_name = $request->guard_name;
        $data->save();
        return redirect()->route('permisos.index')->with('success', 'Permiso creado con éxito.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
