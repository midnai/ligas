<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Liga;
use App\Http\Resources\Liga as LigaResource;
use App\Http\Resources\LigaCollection;

class LigaController extends Controller
{
    public function index()
    {
        return new LigaCollection(Liga::paginate());
    }

    public function show(Liga $liga)
    {
        return new LigaResource($liga);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $validation = [
                'message' => 'Liga no pudo ser creado',
                'errors' => $validator->errors(),
            ];
            return response()->json($validation, 422);
        }

        return new LigaResource(Liga::create($request->all()));
    }

    public function update(Request $request, Liga $liga)
    {
        $liga->update($request->all());

        return new LigaResource($liga);
    }

    public function delete(Request $request, Liga $liga)
    {
        $liga->delete();

        return response()->json(null, 204);
    }
}
