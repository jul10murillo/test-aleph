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
     * Retrieves all records from the CMDB that belong to a specific category.
     *
     * The method uses caching to store the results for 10 minutes. If the cache is empty,
     * it will fetch the records from the Aleph API and store them in the database.
     *
     * @param int $categoriaId The identifier of the category.
     * @return array An array of records.
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
                            'extra_data' => [
                                'fecha_creacion' => $registro['fecha_creacion'] ?? null,
                                'activado' => $registro['activado'] ?? null
                            ],
                        ]
                    );
                }

                Cache::forget("cmdb_records_{$categoriaId}");
                $records = CMDB::where('categoria_id', $categoriaId)->get();

                return $records->map(function ($record) {
                    $record->extra_data = is_array($record->extra_data) ? $record->extra_data : json_decode($record->extra_data, true);
                    return $record;
                });
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
    public function import($file, $categoriaId)
    {
        Excel::import(new CMDBImport($categoriaId), $file);
    }
}