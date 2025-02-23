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

    /**
     * Handles the HTTP request for the categories.index route.
     *
     * Fetches all categories, paginates them and passes them to the
     * categories.index view.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $categories = collect($this->categoryRepository->getAll());

        $perPage = 5;
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
