<?php
namespace App\Http\Controllers\CMDB;

use App\Repositories\Interfaces\CMDBRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

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
            'file' => 'required|mimes:xls,xlsx',
            'categoria_id' => 'required|integer'
        ]);

        try {
            $this->cmdbRepository->import($request->file('file'), $request->categoria_id);
            Cache::forget('cmdb_records_' . $request->categoria_id);
            return redirect()->back()->with('success', 'Registros importados correctamente.');
        } catch (QueryException $e) {
            // 📌 Verifica si es un error de clave única
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'Algunos registros ya existen en la base de datos y no se importaron.');
            }
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}