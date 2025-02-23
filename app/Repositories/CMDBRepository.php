<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CMDBRepositoryInterface;
use App\Models\CMDB;
use App\Services\AlephService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CMDBExport;
use App\Imports\CMDBImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

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
    public function getByCategoryId($categoriaId)
    {
        return Cache::remember("cmdb_records_{$categoriaId}", now()->addMinutes(10), function () use ($categoriaId) {
            try {
                $registrosAPI = $this->alephService->getRegistrosCMDB($categoriaId);
    
                if (empty($registrosAPI)) {
                    return [];
                }
    
                foreach ($registrosAPI as $registro) {
                    CMDB::updateOrCreate(
                        ['identificador' => $registro['identificador']],
                        [
                            'categoria_id' => $categoriaId,
                            'nombre' => $registro['nombre'],
                            'extra_data' => json_encode([
                                'fecha_creacion' => $registro['fecha_creacion'] ?? null,
                                'activado' => $registro['activado'] ?? null
                            ]),
                        ]
                    );
                }
    
                return CMDB::where('categoria_id', $categoriaId)->get();
            } catch (\Exception $e) {
                Log::error("Error en getByCategoryId: " . $e->getMessage());
                return [];
            }
        });
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