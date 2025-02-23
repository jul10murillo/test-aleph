<?php

namespace App\Exports;

use App\Models\CMDB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CMDBExport implements FromCollection, WithHeadings
{
    protected $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        return CMDB::where('categoria_id', $this->categoryId) // Cambiar a 'categoria_id'
            ->get(['id', 'identificador', 'nombre', 'extra_data'])
            ->map(function ($registro) {
                return [
                    'ID' => $registro->id,
                    'Identificador' => $registro->identificador,
                    'Nombre' => $registro->nombre,
                    'Extra Data' => json_encode($registro->extra_data),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Identificador', 'Nombre', 'Extra Data'];
    }
}