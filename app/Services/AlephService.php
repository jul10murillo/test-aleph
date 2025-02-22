<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        $this->subdomainUrl = config('services.aleph.subdomain_url');
    }

    /**
     * Retorna un array con los nombres de las categorias CMDB.
     *
     * @return array
     */
    public function getCategorias()
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get("{$this->baseUrl}/API/get_categorias/")->json();
    }

    /**
     * Retorna un array con los registros de la categoria CMDB especificada.
     *
     * @param int $categoriaId Identificador de la categoria CMDB.
     * @return array
     */
    public function getRegistrosCMDB($categoriaId)
    {
        $url = "{$this->subdomainUrl}/API/get_cmdb/?categoria_id={$categoriaId}";

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($url)->json();
    }
}