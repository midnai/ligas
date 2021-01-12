<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipo;

class EquiposTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.equipos-table', [
            'equipos' => Equipo::paginate(5)
        ]);
    }
}
