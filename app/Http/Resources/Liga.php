<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Liga extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'cantidad_fechas' => $this->cantidad_fechas,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin
        ];
    }
}
