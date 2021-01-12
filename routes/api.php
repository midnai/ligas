<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'throttle:tokens'])->group(function() {

    Route::get('ligas', 'LigaController@index');
    Route::get('ligas/{liga}', 'LigaController@show');
    Route::post('ligas', 'LigaController@store');
    Route::put('ligas/{liga}', 'LigaController@update');
    Route::delete('ligas/{liga}', 'LigaController@delete');
    Route::get('ligas/{liga}/equipos', 'LigaEquipoController@index');
    // Route::post('ligas/{liga}/equipos', 'LigaEquipoController@equipos');
    Route::post('ligas/equipos', 'LigaEquipoController@equipos');

    Route::get('equipos', 'EquipoController@index');
    Route::get('equipos/{equipo}', 'EquipoController@show');
    Route::get('equipos/{equipo}/ligas', 'EquipoLigaController@index');
    Route::get('equipos/{equipo}/jugadores', 'EquipoJugadorController@index');
    Route::post('equipos', 'EquipoController@store');
    Route::put('equipos/{equipo}', 'EquipoController@update');
    Route::delete('equipos/{equipo}', 'EquipoController@delete');

    Route::get('jugadores', 'JugadorController@index');
    Route::get('jugadores/{jugador}', 'JugadorController@show');
    Route::post('jugadores', 'JugadorController@store');
    Route::put('jugadores/{jugador}', 'JugadorController@update');
    Route::delete('jugadores/{jugador}', 'JugadorController@delete');

});

