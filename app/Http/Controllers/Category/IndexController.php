<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(Request $request)
    {
        $categories = collect($this->categoryRepository->getAll()); // Convierte en colección

        // Configurar paginación manualmente
        $perPage = 5; // Número de categorías por página
        $currentPage = $request->query('page', 1);
        $pagedData = $categories->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $categoriesPaginated = new LengthAwarePaginator(
            $pagedData,
            $categories->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('categories.index', ['categories' => $categoriesPaginated]);
    }
}
