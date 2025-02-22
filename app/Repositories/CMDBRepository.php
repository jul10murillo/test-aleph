<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CMDBRepositoryInterface;
use App\Services\AlephService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CMDBExport;
use App\Imports\CMDBImport;

class CMDBRepository implements CMDBRepositoryInterface
{
    protected $alephService;

    public function __construct(AlephService $alephService)
    {
        $this->alephService = $alephService;
    }

    public function getByCategoriaId($categoriaId)
    {
        return $this->alephService->getRegistrosCMDB($categoriaId);
    }

    public function export($categoriaId)
    {
        return Excel::download(new CMDBExport($categoriaId), "CMDB_{$categoriaId}.xlsx");
    }

    public function import($file)
    {
        Excel::import(new CMDBImport, $file);
    }
}