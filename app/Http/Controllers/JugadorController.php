<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jugador;
use App\Http\Resources\Jugador as JugadorResource;
use App\Http\Resources\JugadorCollection;

class JugadorController extends Controller
{
    public function index()
    {
        return new JugadorCollection(Jugador::paginate());
    }

    public function show(Jugador $jugador)
    {
        return new JugadorResource($jugador);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $validation = [
                'message' => 'Jugador no pudo ser creado',
                'errors' => $validator->errors(),
            ];
            return response()->json($validation, 422);
        }

        return new JugadorResource(Jugador::create($request->all()));
    }

    public function update(Request $request, Jugador $jugador)
    {
        $jugador->update($request->all());

        return new JugadorResource($jugador);
    }

    public function delete(Request $request, Jugador $jugador)
    {
        $jugador->delete();

        return response()->json(null, 204);
    }
}
