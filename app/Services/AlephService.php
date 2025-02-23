<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlephService
{
    protected $baseUrl;
    protected $apiKey;

    /**
     * Inicializa la instancia de la clase.
     *
     * Establece los valores de $baseUrl y $apiKey leyendolos desde el archivo de configuracion
     * de Laravel, en la seccion 'services.aleph'.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.aleph.base_url');
        $this->apiKey = config('services.aleph.api_key');
    }


    /**
     * Retorna un array con los registros de las categorias de la API
     * de Aleph, asociados a sus respectivos campos de la tabla CMDB.
     *
     * @return array
     */
    public function getCategories()
    {
        $response = Http::asForm()->post("{$this->baseUrl}/API/get_categorias/", [
            'api_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return collect($data['categorias'])->map(function ($categoria) {
                return [
                    'id' => $categoria['id'],
                    'name' => $categoria['nombre'],
                    'parent_id' => $categoria['categoria_padre_id'],
                    'code' => $categoria['codigo'],
                    'cmdb_fields' => $categoria['campos_cmdb'] ?? []
                ];
            });
        }

        return [];
    }

    /**
     * Retorna un array con los registros de la category CMDB especificada.
     *
     * @param int $categoryId Identificador de la category CMDB.
     * @return array
     */
    public function getRegistrosCMDB($categoriaId)
    {
        $response = Http::asForm()->post("{$this->baseUrl}/API/get_cmdb/", [
            'api_key' => $this->apiKey,
            'categoria_id' => $categoriaId
        ]);

        Log::info("CMDB Response for category {$categoriaId}: " . json_encode($response->json()));

        if ($response->successful()) {
            return $response->json()['cmdb'] ?? [];
        }

        return [];
    }
}