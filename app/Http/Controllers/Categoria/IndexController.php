<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;

class IndexController extends Controller
{
    protected $categoriaRepository;

    public function __construct(CategoriaRepositoryInterface $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function __invoke()
    {
        $categorias = $this->categoriaRepository->getAll();
        return view('categorias.index', compact('categorias'));
    }
}
