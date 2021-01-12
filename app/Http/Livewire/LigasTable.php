<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Liga;

class LigasTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.ligas-table', [
            'ligas' => Liga::paginate(10)
        ]);
    }
}
