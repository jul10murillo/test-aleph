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

    /**
     * Handle the export of CMDB records for a given category.
     *
     * @param int $categoryId The ID of the category to export records for.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse The response containing the exported Excel file.
     */

    public function __invoke($categoryId)
    {
        return $this->cmdbRepository->export($categoryId);
    }
}
