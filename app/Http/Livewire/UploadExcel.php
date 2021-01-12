<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\EquiposImport;

class UploadExcel extends Component
{
    use WithFileUploads;

    public $excel;
    public function render()
    {
        return view('livewire.upload-excel');
    }


    public function save()
    {
        $this->validate([
            'excel' => 'mimes:xlsx|max:1024', // 1MB Max
        ]);

        (new EquiposImport)->import($this->excel);

        // return response()->json('Archivo importado exitosamente!', 200);
        // $this->excel->store('excels');
    }
}
