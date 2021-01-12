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

    Route::get('ligas', 'Api\LigaController@index');
    Route::get('ligas/{liga}', 'Api\LigaController@show');
    Route::get('ligas/{liga}/equipos', 'Api\LigaEquipoController@index');
    Route::post('ligas', 'Api\LigaController@store');
    Route::post('ligas/equipos', 'Api\LigaEquipoController@equipos');
    Route::put('ligas/{liga}', 'Api\LigaController@update');
    Route::delete('ligas/{liga}', 'Api\LigaController@delete');

    Route::get('equipos', 'Api\EquipoController@index');
    Route::get('equipos/{equipo}', 'Api\EquipoController@show');
    Route::get('equipos/{equipo}/ligas', 'Api\EquipoLigaController@index');
    Route::get('equipos/{equipo}/jugadores', 'Api\EquipoJugadorController@index');
    Route::post('equipos', 'Api\EquipoController@store');
    Route::put('equipos/{equipo}', 'Api\EquipoController@update');
    Route::delete('equipos/{equipo}', 'Api\EquipoController@delete');

    Route::get('jugadores', 'Api\JugadorController@index');
    Route::get('jugadores/{jugador}', 'Api\JugadorController@show');
    Route::post('jugadores', 'Api\JugadorController@store');
    Route::put('jugadores/{jugador}', 'Api\JugadorController@update');
    Route::delete('jugadores/{jugador}', 'Api\JugadorController@delete');

});

