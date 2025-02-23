<?php

namespace App\Http\Controllers\CMDB;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CMDBRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class ShowController extends Controller
{
    protected $cmdbRepository;

    public function __construct(CMDBRepositoryInterface $cmdbRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->cmdbRepository = $cmdbRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function __invoke($categoryId)
    {
        $records = $this->cmdbRepository->getByCategoryId($categoryId);

        // Obtener el nombre de la categoría desde la API
        $categories = $this->categoryRepository->getAll();
        $categoryName = collect($categories)->firstWhere('id', $categoryId)['name'] ?? 'Unknown';

        return view('cmdb.index', [
            'records' => collect($records),
            'categoryId' => $categoryId,
            'categoryName' => $categoryName
        ]);
    } 
}
