<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\AlephService;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $alephService;

    public function __construct(AlephService $alephService)
    {
        $this->alephService = $alephService;
    }

    /**
     * Retrieves all categories from the API.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->alephService->getCategories();
    }
}