<?php

namespace App\Repositories\Interfaces;

interface CMDBRepositoryInterface
{
    public function getByCategoriaId($categoriaId);
    public function export($categoriaId);
    public function import($file);
}
