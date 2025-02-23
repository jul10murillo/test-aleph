<?php

namespace App\Http\Controllers\CMDB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CMDBTemplateExport;

class TemplateController extends Controller
{
    public function downloadTemplate()
    {
        return Excel::download(new CMDBTemplateExport, 'cmdb_import_template.xlsx');
    }
}
