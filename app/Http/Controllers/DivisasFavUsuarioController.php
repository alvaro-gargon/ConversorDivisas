<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DivisasFavUsuario;
use App\Models\Usuario;

class DivisasFavUsuarioController extends Controller
{
    /**
     * Obtiene el id del perfil 'usuarios' del usuario autenticado.
     */
    private function getIdUsuario()
    {
        return Usuario::where('user_id', '=', Auth::id())->value('id');
    }

    /**
     * Devuelve los iso_codes favoritos del usuario autenticado.
     *
     * GET /api/favoritos
     */
    public function index()
    {
        $favoritos = DivisasFavUsuario::where('id_usuario', '=', $this->getIdUsuario())
            ->pluck('id_divisa');

        return response()->json($favoritos);
    }

    /**
     * Añade una divisa a favoritos.
     *
     * POST /api/favoritos
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_divisa' => 'required|string|size:3',
        ]);

        DivisasFavUsuario::firstOrCreate([
            'id_usuario' => $this->getIdUsuario(),
            'id_divisa'  => strtoupper($request->id_divisa),
        ]);

        return response()->json(['ok' => true]);
    }

    /**
     * Elimina una divisa de favoritos.
     *
     * DELETE /api/favoritos/{iso_code}
     */
    public function destroy(string $idDivisa)
    {
        DivisasFavUsuario::where('id_usuario', '=', $this->getIdUsuario())
            ->where('id_divisa', '=', strtoupper($idDivisa))
            ->delete();

        return response()->json(['ok' => true]);
    }
}