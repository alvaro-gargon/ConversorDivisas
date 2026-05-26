<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

/*Metodo añadido para controlar el movimiento entre paginas sin que ocurra errores.
La pagina siempre se dirige a la vista principal independientemente de lo que ponga en la URI
*/
Route::get('/{any}', function () {
    return view('app'); 
})->where('any', '.*');
