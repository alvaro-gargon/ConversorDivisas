<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversorController extends Controller
{
    /**
     * Obtiene el tipo de cambio entre dos divisas usando la API de Frankfurter.
     *
     * GET /api/convertir?desde=USD&hasta=EUR
     */
    public function convertir(Request $request)
    {
        $request->validate([
            'desde' => 'required|string|size:3',
            'hasta' => 'required|string|size:3',
        ]);

        $desde = strtoupper($request->desde);
        $hasta = strtoupper($request->hasta);

        $respuesta = Http::get('https://api.frankfurter.dev/v2/rates', [
            'base'   => $desde,
            'quotes' => $hasta,
        ]);

        if ($respuesta->failed()) {
            return response()->json([
                'error' => 'No se pudo obtener el tipo de cambio.'
            ], 502);
        }

        $datos      = $respuesta->json();
        $tipoCambio = $datos[0]['rate'] ?? null;

        if (!$tipoCambio) {
            return response()->json([
                'error' => "No hay tipo de cambio disponible para {$hasta}."
            ], 404);
        }

        $fechaFormateada=Carbon::parse($datos[0]['date'])->format('d/m/Y');

        return response()->json([
            'desde'      => $desde,
            'hasta'      => $hasta,
            'tipoCambio' => $tipoCambio,
            'fecha'      => $fechaFormateada,
        ]);
    }
}