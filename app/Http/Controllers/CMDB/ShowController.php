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

    public function __invoke($categoryId)
    {
        $registros = $this->cmdbRepository->getBycategoryId($categoryId);
        return view('cmdb.index', compact('registros', 'categoryId'));
    }
}
