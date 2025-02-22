<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CategoriaRepositoryInterface;
use App\Services\AlephService;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    protected $alephService;

    public function __construct(AlephService $alephService)
    {
        $this->alephService = $alephService;
    }

    public function getAll()
    {
        return $this->alephService->getCategorias();
    }
}