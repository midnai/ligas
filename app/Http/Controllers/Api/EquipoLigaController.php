<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
