<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoricoController extends Controller
{
    public function historico(Request $request)
    {
        $request->validate([
            'divisa'      => 'required|string|size:3',
            'fecha_inicio' => 'required|date_format:Y-m-d|after_or_equal:2006-08-01',
            'fecha_fin'   => 'required|date_format:Y-m-d|before_or_equal:today',
        ]);

        $divisa = strtoupper($request->divisa); //forzamos la converion a mayusculas por si acaso
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        // comprobacion de que la moneda que buscamos es la del euro
        if ($divisa === 'EUR') {
            return response()->json([
                'divisa' => 'EUR',
                'datos'  => [], // Se usa el JSON del oro 
                'es_eur' => true,
            ]);
        }

        $response = Http::get('https://api.frankfurter.dev/v2/rates', [
            'base' => 'EUR',
            'quotes' => $divisa,
            'from' => $fechaInicio,
            'to' => $fechaFin,
            'group' => 'month',
        ]);


        if ($response->failed()) {
            return response()->json([
                'error' => 'No se pudo obtener el histórico de Frankfurter.'
            ], 502);
        }

        $body = json_decode($response->body(), true);

        if (empty($body)) {
            return response()->json([
                'error' => 'No hay datos históricos para esta divisa en el rango indicado.'
            ], 404);
        }

        //renombramiento de los campos JSON
        $datos = array_map(function ($entrada) {
            return [
                'fecha' => $entrada['date'],
                'tipoCambio' => $entrada['rate'] ?? null, //si por algun motivo en un mes no hay valor, le ponemos null
            ];
        }, $body);

        //array filter elimina las entradas donde el valor de tipo de cambio es null
        //array values vuelve a indexar el array despues del filtrado.
        $datos = array_values(array_filter($datos, fn($d) => $d['tipoCambio'] !== null));

        return response()->json([
            'divisa' => $divisa,
            'datos' => $datos,
            'es_eur' => false,
        ]);
    }
}