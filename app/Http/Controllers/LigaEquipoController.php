<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Equipo as EquipoResource;
use App\Http\Resources\EquipoCollection;
use App\Models\Liga;
use App\Imports\EquiposImport;

class LigaEquipoController extends Controller
{
    public function index($id)
    {
        return new EquipoCollection(Liga::find($id)->equipos()->paginate());
    }

    public function equipos()
    {
        // (new EquiposImport)->import(request()->file('your_file'));
        (new EquiposImport)->import('test.xlsx');

        return response()->json('Archivo importado exitosamente!', 200);
    }
}
