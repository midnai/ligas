<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Http\Resources\LigaCollection;

class EquipoLigaController extends Controller
{
    public function index($id)
    {
        return new LigaCollection(Equipo::find($id)->ligas()->paginate());
    }
}
