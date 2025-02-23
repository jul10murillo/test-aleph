<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class CMDBTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'Identificador',
            'Nombre',
            'Fecha de Creación',
            'Activado'
        ];
    }

    public function array(): array
    {
        return [
            ['', '', '', ''] // Fila vacía como ejemplo
        ];
    }
}