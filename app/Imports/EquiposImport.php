<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\Models\Equipo;
use App\Models\Liga;

class EquiposImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
     use Importable;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $equipo = new Equipo([
            'nombre' => $row['equipo_nombre'],
            'pais' => $row['pais'],
            'ciudad' => $row['ciudad'],
            'estadio' => $row['estadio'],
            'logo' => 'https://ui-avatars.com/api/?name='.urlencode($row['equipo_nombre']).'&color=7F9CF5&background=EBF4FF'
        ]);
        $equipo->save();

        $liga = Liga::find($row['liga']);

        $equipo->ligas()->attach($liga);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

}
