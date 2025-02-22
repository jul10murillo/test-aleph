<?php

namespace App\Http\Controllers\CMDB;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CMDBRepositoryInterface;

class ExportController extends Controller
{
    protected $cmdbRepository;

    public function __construct(CMDBRepositoryInterface $cmdbRepository)
    {
        $this->cmdbRepository = $cmdbRepository;
    }

    public function __invoke($categoriaId)
    {
        return $this->cmdbRepository->export($categoriaId);
    }
}
