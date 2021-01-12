<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';
    protected $fillable = ['nombre', 'equipo_id'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
