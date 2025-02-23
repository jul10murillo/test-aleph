<?php

namespace App\Imports;

use App\Models\CMDB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class CMDBImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['identificador']) || empty($row['nombre'])) {
            throw new \Exception("Faltan datos obligatorios: Identificador o Nombre.");
        }
        
        $fechaCreacion = is_numeric($row['fecha_de_creacion']) 
            ? Carbon::createFromFormat('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_de_creacion'])->format('Y-m-d')) 
            : $row['fecha_de_creacion'];

        $activado = filter_var($row['activado'], FILTER_VALIDATE_BOOLEAN);

        
        return new CMDB([
            'categoria_id' => request()->input('categoria_id', 1), // Default 1 si no se pasa
            'identificador' => $row['identificador'],
            'nombre' => $row['nombre'],
            'extra_data' => [
                'fecha_creacion' => $fechaCreacion ?? null,
                'activado' =>  $activado ?? null
            ],
        ]);
    }
}