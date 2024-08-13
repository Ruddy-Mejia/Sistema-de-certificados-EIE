<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Key;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KeyController extends Controller
{
    public function index()
    {
        // if (!auth()->user()->can('ver certificados')) {
        //     throw new AuthorizationException('No tienes permisos suficientes.');
        // }
        return view("keys.index");
    }

    public function update(Request $request)
    {
        // if (!auth()->user()->can('ver certificados')) {
        //     throw new AuthorizationException('No tienes permisos suficientes.');
        // }
        try {
            $clave = Key::where('usuario_id', '=', auth()->user()->id)->first();
            // echo Hash::make('asd');
            if (Hash::check($request['old_password'], $clave->clave)) {
                try {
                    $clave->clave = Hash::make($request['new_password']);
                    $clave->save();
                    return back()->with('status', 'Se cambio la clave de forma correcta');
                } catch (\Exception $e) {
                    return back()->withError($e->getMessage());
                }
            } else {
                return back()->withError('Las claves no coinciden');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
