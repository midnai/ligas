<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Liga;
use App\Models\Jugador;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ligas()
    {
        return $this->belongsToMany(Liga::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
}
