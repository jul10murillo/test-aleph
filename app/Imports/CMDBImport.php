<?php

namespace App\Imports;

use App\Models\CMDB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CMDBImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CMDB([
            'category_id'  => $row['category_id'],
            'identificador' => trim($row['identificador']),
            'nombre'        => trim($row['nombre']),
            'extra_data'    => isset($row['extra_data']) ? json_decode($row['extra_data'], true) : null,
        ]);
    }
}
