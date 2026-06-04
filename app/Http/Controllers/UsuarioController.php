<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    private function getIdUsuario()
    {
        return Usuario::where('user_id', '=', Auth::id())->value('id');
    }

    public function getFotoPerfil()
    {
        $fotoPerfil = Usuario::where('id', $this->getIdUsuario())->value('imagen_usuario');
        // dd($fotoPerfil);
       return response()->json(['imagen_usuario' => $fotoPerfil]);
    }

    //se usa esto para acceder a los avatares de la carpeta public/images/avatares
    public function getAvatares()
    {
        $archivos = array_diff(scandir(public_path('images/avatares')), ['.', '..']);
        return response()->json(array_values($archivos));
    }

    public function editarFotoPerfil(Request $request)
    {
        Usuario::where('id', $this->getIdUsuario())->update(['imagen_usuario' => $request->imagen_usuario]);
        return response()->json(['message' => 'Avatar actualizado']);
    }
}
