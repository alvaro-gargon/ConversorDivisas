<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentificacionController extends Controller
{
    public function registro(Request $request)
    {
        $usuario = User::create([
            'name'     => $request->nombre,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'token' => $usuario->createToken('app')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
        return response()->json([
            'token' => Auth::user()->createToken('app')->plainTextToken
        ]);
    }
}
