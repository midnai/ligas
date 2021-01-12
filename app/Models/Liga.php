<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Liga extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class);
    }
}
