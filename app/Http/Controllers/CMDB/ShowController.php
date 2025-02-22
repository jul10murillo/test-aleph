<?php

namespace App\Http\Controllers\CMDB;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CMDBRepositoryInterface;

class ShowController extends Controller
{
    protected $cmdbRepository;

    public function __construct(CMDBRepositoryInterface $cmdbRepository)
    {
        $this->cmdbRepository = $cmdbRepository;
    }

    public function __invoke($categoriaId)
    {
        $registros = $this->cmdbRepository->getByCategoriaId($categoriaId);
        return view('cmdb.index', compact('registros', 'categoriaId'));
    }
}
