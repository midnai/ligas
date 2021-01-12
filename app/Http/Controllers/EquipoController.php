<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Equipo;
use App\Http\Resources\Equipo as EquipoResource;
use App\Http\Resources\EquipoCollection;

class EquipoController extends Controller
{
    public function index()
    {
        return new EquipoCollection(Equipo::paginate());
    }

    public function show(Equipo $equipo)
    {
        return new EquipoResource($equipo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $validation = [
                'message' => 'Equipo no pudo ser creado',
                'errors' => $validator->errors(),
            ];
            return response()->json($validation, 422);
        }

        return new EquipoResource(Equipo::create($request->all()));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $equipo->update($request->all());

        return new EquipoResource($equipo);
    }

    public function delete(Request $request, Equipo $equipo)
    {
        $equipo->delete();

        return response()->json(null, 204);
    }
}
