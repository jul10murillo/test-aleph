<?php

namespace App\Http\Controllers\CMDB;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CMDBRepositoryInterface;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    protected $cmdbRepository;

    public function __construct(CMDBRepositoryInterface $cmdbRepository)
    {
        $this->cmdbRepository = $cmdbRepository;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xls,xlsx',
        ]);

        $this->cmdbRepository->import($request->file('archivo'));

        return back()->with('success', 'Registros importados con éxito.');
    }
}
