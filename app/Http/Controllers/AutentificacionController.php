<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AutentificacionController extends Controller
{
    public function registro(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', // <-- evita el duplicado
            'password' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'     => $request->nombre,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Usuario::create([
                'user_id' => $user->id,
                'nombre_usuario' => $request->nombre,
            ]);

            $token = $user->createToken('app')->plainTextToken;

            DB::commit();

            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'mensaje' => $e->getMessage(),
            ], 500);
        }
        
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
