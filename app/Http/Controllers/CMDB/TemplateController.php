<?php

namespace App\Http\Controllers\CMDB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CMDBTemplateExport;

class TemplateController extends Controller
{
    /**
     * Descarga una plantilla de importaci n de registros de la CMDB en formato Excel.
     * La plantilla tiene los siguientes campos:
     * <ul>
     * <li>Identificador (requerido)</li>
     * <li>Nombre (requerido)</li>
     * <li>Fecha de Creaci n (requerido)</li>
     * <li>Activado (opcional)</li>
     * </ul>
     * El archivo se devuelve con el nombre <code>cmdb_import_template.xlsx</code>.
     */
    public function downloadTemplate()
    {
        return Excel::download(new CMDBTemplateExport, 'cmdb_import_template.xlsx');
    }
}
