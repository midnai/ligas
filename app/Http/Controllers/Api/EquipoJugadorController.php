<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Http\Resources\JugadorCollection;

class EquipoJugadorController extends Controller
{
    public function index($id)
    {
        return new JugadorCollection(Equipo::find($id)->jugadores()->paginate());
    }
}
