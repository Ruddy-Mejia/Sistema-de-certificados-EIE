<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;

class RolesController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('ver roles')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        try {
            $roles = Role::with('permissions')->get();

            $data = [
                'roles' => $roles,
            ];

            return view('roles.index', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function create()
    {
        if (!auth()->user()->can('ver roles')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        try {
            $roles = Role::with('permissions')->get();
            $permisions = Permission::all();
            $data = [
                'roles' => $roles,
                'permisions' => $permisions,
            ];

            return view('roles.roles', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $role = Role::create([
                'name' => $request->input('nombreRol'),
                'guard_name' => 'web',
            ]);
            $permissions = $request->input('permissions', []);
            $role->syncPermissions($permissions);

            return redirect()->route('roluser.index')->with('success', 'Rol creado con éxito.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
