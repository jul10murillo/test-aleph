<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CMDBRepositoryInterface;
use App\Models\CMDB;
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

    /**
     * Obtener registros CMDB de la API y guardarlos en la base de datos.
     */
    public function getBycategoryId($categoryId)
    {
        $registrosAPI = $this->alephService->getRegistrosCMDB($categoryId);

        // Guardar en la base de datos si no existen
        foreach ($registrosAPI as $registro) {
            CMDB::updateOrCreate(
                ['identificador' => $registro['identificador']],
                [
                    'category_id' => $categoryId,
                    'nombre' => $registro['nombre'],
                    'extra_data' => isset($registro['extra_data']) ? json_encode($registro['extra_data']) : null,
                ]
            );
        }

        return CMDB::where('category_id', $categoryId)->get();
    }

    /**
     * Almacenar un nuevo registro en la base de datos.
     */
    public function store(array $data)
    {
        return CMDB::create($data);
    }

    /**
     * Exportar registros CMDB de una categoría a un archivo Excel.
     */
    public function export($categoryId)
    {
        return Excel::download(new CMDBExport($categoryId), "CMDB_{$categoryId}.xlsx");
    }

    /**
     * Importar registros CMDB desde un archivo Excel.
     */
    public function import($file)
    {
        Excel::import(new CMDBImport, $file);
    }
}